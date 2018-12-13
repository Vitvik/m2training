<?php

namespace Training\CustomerPersonalSite\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{

    private $customerSetupFactory;


    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }


    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $attributeName = 'personal_site';
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeName , [
            'type' => 'varchar',
            'label' => 'Personal Site URL',
            'input' => 'text',
            'validation_rules'=>'{"max_text_length":250,"input_validation":"url","validate-url":true}',
            'required' => false,
            'system' => false,
            'user_defined' => true,
            'group' => 'General',
            'unique' => true,
            'sort_order' => 300,
            'position' => 300
        ]);

//        $attribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'personal_customer_info');
//        $attribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_edit']);
//        $attribute->save();

        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY,
            $attributeName);
                $setup->getConnection()->insertMultiple($setup->getTable('customer_form_attribute'), [
            ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
            ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
            ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId]
        ]);
    }
}
