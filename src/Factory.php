<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Pass;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

#[Attribute('xmlns', 'urn:schemas-microsoft-com:unattend')]
class Factory extends Container
{
    use ExportTrait;

    #[Pass(['windowsPE', 'specialize'])]
    public ?TCPIP $tcpip = null;

    #[Pass('windowsPE')]
    public ?Setup $setup = null;

    #[Pass('specialize')]
    public ?Deployment $deployment = null;

    #[Pass('offlineServicing')]
    public ?LUASettings $luaSettings = null;

    #[Pass(['windowsPE', 'specialize'])]
    public ?DnsClient $dnsClient = null;

    #[Pass(['windowsPE', 'specialize'])]
    public ?NetBT $netBT = null;

    #[Pass(['specialize', 'oobeSystem'])]
    public ?ShellSetup $shellSetup = null;

    #[Pass('specialize')]
    public ?SecuritySPP $securitySPP = null;

    #[Pass('specialize')]
    public ?LocalSessionManager $localSessionManager = null;

    #[Pass('specialize')]
    public ?MPSSVC $mpssvc = null;

    #[Pass('specialize')]
    public ?SystemRestore $systemRestore = null;

    #[Pass('specialize')]
    public ?WindowsDefender $windowsDefender = null;

    #[Pass('windowsPE')]
    public ?SetupInternational $setupInternational = null;

    public function toXML(): string
    {
        $encoder = new XmlEncoder();

        $xml = $encoder->encode($this->jsonSerialize(), 'xml', [
            'xml_format_output' => true,
            'xml_root_node_name' => 'unattend',
        ]);
        $xml = str_replace("\n", "\r\n", $xml);

        return $xml;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(?string $pass = null): array
    {
        $data = [];
        if (null === $pass) {
            $data['servicing'] = null;
            $data['settings'] = new Container();
            foreach (['windowsPE', 'offlineServicing', 'oobeSystem', 'specialize', 'generalize', 'auditSystem', 'auditUser'] as $p) {
                $components = [];
                foreach ($this->getPropertiesForPass($p) as $property) {
                    if ('items' === $property->getName()) {
                        continue;
                    }
                    $component = $this->{$property->getName()}->jsonSerialize($p);
                    foreach ($this->prepareComponent($component) as $item) {
                        $components = $this->merge($components, $item);
                    }
                }
                if (empty($components)) {
                    continue;
                }
                $data['settings']->items[] = new Settings($p, $components);
            }
            $data = array_replace($data, $this->toArrayClass());
            $data = $this->wrapClass($data);
        }

        return $data;
    }

    protected function prepareComponent(array $component, array $archs = ['x86', 'amd64'])
    {
        $defaultValues = [
            'publicKeyToken' => '31bf3856ad364e35',
            'language' => 'neutral',
            'versionScope' => 'nonSxS',
            'xmlns:wcm' => 'http://schemas.microsoft.com/WMIConfig/2002/State',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
        ];
        $outputs = [];
        foreach ($archs as $arch) {
            $component['component']['@processorArchitecture'] = $arch;
            foreach ($defaultValues as $key => $value) {
                if (!isset($component['component']['@'.$key])) {
                    $component['component']['@'.$key] = $value;
                }
            }
            $outputs[] = $component;
        }

        return $outputs;
    }
}
