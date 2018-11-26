<?php
namespace Training\Test\Plugin\Block;

class Template
{
    public function afterToHtml(
        \Magento\Framework\View\Element\Template $subject,
        $result
    ){
        /*
         * task_8.1_1
         */
//      return $result = '<div><p>'. $subject->getTemplate() . '</p>'.'<p>' . get_class($subject) . '</p>' . $result .'</div>';

    if ($subject->getNameInLayout() == 'top.search'){
       $result = '<div><p>'. $subject->getTemplate() . '</p>'.'<p>' . get_class($subject) . '</p>' . $result .'</div>';
    }

    return $result;
    }
}