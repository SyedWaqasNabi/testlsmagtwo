<?php
namespace Ls\Omni\Console\Command;

use Ls\Omni\Console\Command;
use Ls\Omni\Service\Service;
use Ls\Omni\Service\Soap\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClientWsdl extends Command
{
    const COMMAND_NAME = 'omni:client:wsdl';

    protected function configure () {

        $this->setName( self::COMMAND_NAME )
             ->setDescription( 'show WSDL contents' )
             ->addOption( 'type', 't', InputOption::VALUE_REQUIRED, 'omni service type', 'ecommerce' )
             ->addOption( 'base', 'b', InputOption::VALUE_OPTIONAL, 'omni service base url' );
    }

    protected function execute ( InputInterface $input, OutputInterface $output ) {

        $wsdl = Service::getUrl( $this->type, $this->base_url );
        $client = new Client( $wsdl, $this->type );

        $this->output->writeln( $client->getWsdlXml()->saveXML() );
    }
}
