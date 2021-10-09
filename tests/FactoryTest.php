<?php

use dnj\Autounattend\Command;
use dnj\Autounattend\Deployment;
use dnj\Autounattend\DnsClient;
use dnj\Autounattend\Factory;
use dnj\Autounattend\LocalSessionManager;
use dnj\Autounattend\LUASettings;
use dnj\Autounattend\MPSSVC;
use dnj\Autounattend\NetBT;
use dnj\Autounattend\Password;
use dnj\Autounattend\SecuritySPP;
use dnj\Autounattend\Setup;
use dnj\Autounattend\SetupInternational;
use dnj\Autounattend\ShellSetup;
use dnj\Autounattend\SystemRestore;
use dnj\Autounattend\TCPIP;
use dnj\Autounattend\WindowsDefender;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testExport(): void
    {
        $ethernetIdentifier = 'Ethernet0';
        $ips = ['10.1.0.2/24'];
        $gateway = '10.1.0.1';
        $dnses = ['8.8.8.8', '8.8.4.4'];
        $password = new Password('123456', true);

        $defaultRoute = new TCPIP\NetworkInterface\Route('0.0.0.0/0', 20, $gateway);
        $ethernet = new TCPIP\NetworkInterface($ethernetIdentifier, [$defaultRoute]);
        $ethernet->ipv4Settings = new TCPIP\NetworkInterface\IpSettings(false);
        $ethernet->ipv6Settings = new TCPIP\NetworkInterface\IpSettings(false);
        $ethernet->unicastIpAddresses = $ips;
        $tcpip = new TCPIP([$ethernet]);

        $dnsClient = new DnsClient();

        $ethernet = new DnsClient\NetworkInterface($ethernetIdentifier);
        $ethernet->dnsServerSearchOrder = [];
        foreach ($dnses as $x => $dns) {
            $ethernet->dnsServerSearchOrder[] = new DnsClient\IpAddress($dns, "{$x}");
        }
        $dnsClient->interfaces = [$ethernet];

        $netBT = new NetBT();

        $ethernet = new NetBT\NetworkInterface($ethernetIdentifier, $dnses);
        $netBT->interfaces = [$ethernet];

        $setup = new Setup();

        $setup->enableNetwork = true;
        $setup->enableFirewall = false;

        $createMSR = new Setup\DiskConfiguration\Disk\CreatePartition('Primary', 350);
        $modifyMSR = new Setup\DiskConfiguration\Disk\ModifyPartition(1);
        $modifyMSR->active = true;
        $modifyMSR->format = 'NTFS';
        $modifyMSR->label = 'System Reserved';
        $modifyMSR->typeID = '0x27';

        $createC = new Setup\DiskConfiguration\Disk\CreatePartition('Primary', null, true);
        $modifyC = new Setup\DiskConfiguration\Disk\ModifyPartition(2);
        $modifyC->active = true;
        $modifyC->extend = false;
        $modifyC->format = 'NTFS';
        $modifyC->label = 'Windows';

        $disk0 = new Setup\DiskConfiguration\Disk(0);
        $disk0->willWipeDisk = true;
        $disk0->createPartitions = [$createMSR, $createC];
        $disk0->modifyPartitions = [$modifyMSR, $modifyC];

        $diskConfiguration = new Setup\DiskConfiguration();
        $diskConfiguration->disks = [$disk0];
        $diskConfiguration->willShowUI = 'OnError';

        $setup->diskConfiguration = $diskConfiguration;

        $userData = new Setup\UserData();
        $userData->acceptEula = true;
        $userData->fullName = 'Administrator';
        $userData->organization = 'Organization';

        $setup->userData = $userData;

        $installTo = new Setup\ImageInstall\Image\InstallTo(0, 2);
        $installFrom = new Setup\ImageInstall\Image\InstallFrom();
        $installFrom->metaData = [
            new Setup\ImageInstall\Image\InstallFrom\MetaData('/IMAGE/INDEX', '1'),
            new Setup\ImageInstall\Image\InstallFrom\MetaData('/IMAGE/INDEX1', '2'),
        ];

        $osImage = new Setup\ImageInstall\Image();
        $osImage->installTo = $installTo;
        $osImage->installFrom = $installFrom;
        $osImage->willShowUI = 'OnError';

        $imageInstall = new Setup\ImageInstall($osImage);

        $setup->imageInstall = $imageInstall;

        $setupInternational = new SetupInternational();

        $setupUILanguage = new SetupInternational\SetupUILanguage();
        $setupUILanguage->uiLanguage = 'en-US';

        $setupInternational->setupUILanguage = $setupUILanguage;
        $setupInternational->inputLocale = 'en-US';
        $setupInternational->uiLanguage = 'en-US';
        $setupInternational->uiLanguageFallback = 'en-US';
        $setupInternational->userLocale = 'en-US';
        $setupInternational->systemLocale = 'en-US';

        $luaSettings = new LUASettings();

        $luaSettings->enableLUA = false;

        $shellSetup = new ShellSetup();

        $shellSetup->computerName = '*';
        $shellSetup->timeZone = 'Iran Standard Time';
        $shellSetup->registeredOwner = '';

        $autoLogon = new ShellSetup\AutoLogon();
        $autoLogon->enabled = true;
        $autoLogon->username = 'Administrator';
        $autoLogon->password = $password;

        $shellSetup->autoLogon = $autoLogon;

        $userAccounts = new ShellSetup\UserAccounts();
        $userAccounts->administratorPassword = $password;

        $shellSetup->userAccounts = $userAccounts;

        $oobe = new ShellSetup\OOBE();
        $oobe->hideEULAPage = true;
        $oobe->hideOEMRegistrationScreen = true;
        $oobe->hideOnlineAccountScreens = true;
        $oobe->hideWirelessSetupInOOBE = true;
        $oobe->networkLocation = 'Other';
        $oobe->protectYourPC = 1;

        $shellSetup->oobe = $oobe;

        $openICMP = new Command(
                    'cmd.exe /c netsh advfirewall firewall add rule name=ICMP protocol=icmpv4 dir=in action=allow',
                    'Open the firewall for ICMP traffic.'
                );
        $disableAutoUpdate = new Command(
                    "cmd /c reg.exe add \"HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\WindowsUpdate\Auto Update\" /v AUOptions /t REG_DWORD /d 2 /f",
                    'Disable Windows Auto Update'
                );

        $shellSetup->firstLogonCommands = [$openICMP, $disableAutoUpdate];

        $securitySPP = new SecuritySPP();

        $securitySPP->skipAutoActivation = true;

        $localSessionManager = new LocalSessionManager();

        $localSessionManager->fDenyTSConnections = false;

        $mpssvc = new MPSSVC();

        $remoteDesktopGroup = new MPSSVC\FirewallGroup('@FirewallAPI.dll,-28752', 'RemoteDesktop', 'all', true);
        $mpssvc->firewallGroups = [$remoteDesktopGroup];

        $systemRestore = new SystemRestore();

        $systemRestore->disableSR = 1;

        $windowsDefender = new WindowsDefender();

        $windowsDefender->disableAntiSpyware = true;

        $enableAdmin = new Command(
            'cmd /c net user Administrator /active:yes',
            'Enable built-in admin.'
        );
        $deployment = new Deployment();
        $deployment->runAsynchronous = [$enableAdmin];
        $deployment->runSynchronous = [$enableAdmin];

        $factory = new Factory();
        $factory->tcpip = $tcpip;
        $factory->dnsClient = $dnsClient;
        $factory->netBT = $netBT;
        $factory->setup = $setup;
        $factory->setupInternational = $setupInternational;
        $factory->luaSettings = $luaSettings;
        $factory->shellSetup = $shellSetup;
        $factory->localSessionManager = $localSessionManager;

        $factory->securitySPP = $securitySPP;
        $factory->mpssvc = $mpssvc;
        $factory->systemRestore = $systemRestore;
        $factory->windowsDefender = $windowsDefender;
        $factory->deployment = $deployment;

        $xml = $factory->toXML();
        echo $xml;
    }
}
