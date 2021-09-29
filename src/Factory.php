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

        return $encoder->encode($this->jsonSerialize(), 'xml', [
            'xml_format_output' => true,
            'xml_root_node_name' => 'unattend',
        ]);
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
                    $components = $this->merge($components, $component);
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
}
