<?php

namespace Ls\Replication\Code;

use Ls\Omni\Service\Soap\ReplicationOperation;
use Magento\Framework\Api\SearchCriteriaInterface;
use ReflectionClass;
use Zend\Code\Generator\FileGenerator;
use Zend\Code\Generator\GeneratorInterface;
use Zend\Code\Generator\ParameterGenerator;

class RepositoryInterfaceGenerator implements GeneratorInterface
{
    /** @var string */
    static public $namespace = "Ls\\Replication\\Api";

    /** @var  ReplicationOperation */
    private $operation;

    /** @var FileGenerator */
    private $file;

    /** @var InterfaceGenerator */
    private $class;

    /** @var ReflectionClass */
    private $reflected_entity;

    /**
     * RepositoryInterfaceGenerator constructor.
     * @param ReplicationOperation $replication_operation
     * @throws \ReflectionException
     */
    public function __construct(ReplicationOperation $replication_operation)
    {
        $this->operation = $replication_operation;
        $this->reflected_entity = new ReflectionClass($this->operation->getMainEntityFqn());
        $this->file = new FileGenerator();
        $this->class = new InterfaceGenerator();
        $this->file->setClass($this->class);
    }

    /**
     * @return string
     */
    public function generate()
    {

        /**
         * public function save(ThingInterface $page);
         * public function getById($id);
         * public function getList(SearchCriteriaInterface $criteria);
         * public function delete(ThingInterface $page);
         * public function deleteById($id);
         */

        $entity_interface_name = $this->operation->getInterfaceName();
        $this->class->setName($this->getName());
        $this->class->setNamespaceName(self::$namespace);
        $this->class->addUse($this->operation->getInterfaceFqn());
        $this->class->addUse(SearchCriteriaInterface::class);
        $this->class->addMethod('getList', [new ParameterGenerator('criteria', SearchCriteriaInterface::class)]);
        $this->class->addMethod('save', [new ParameterGenerator('page', $entity_interface_name)]);
        $this->class->addMethod('delete', [new ParameterGenerator('page', $entity_interface_name)]);
        $this->class->addMethod('getById', [new ParameterGenerator('id')]);
        $this->class->addMethod('deleteById', [new ParameterGenerator('id')]);

        $content = $this->file->generate();
        $not_abstract = <<<CODE

    {
    }
CODE;

        $content = str_replace("\\$entity_interface_name \$page", "$entity_interface_name \$page", $content);
        $content = str_replace(
            "\Magento\\Framework\\Api\\SearchCriteriaInterface \$criteria",
            "SearchCriteriaInterface \$criteria",
            $content
        );
        $content = preg_replace('/\s+{\s+}+/', ";\n", $content);
        return $content;
    }

    /**
     * @return string
     */
    public function getName()
    {

        return $this->operation->getRepositoryInterfaceName();
    }
}
