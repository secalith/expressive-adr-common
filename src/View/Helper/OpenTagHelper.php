<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\View\Helper;

use Zend\View\Helper\AbstractHelper;

class OpenTagHelper extends AbstractHelper
{
    protected $tagsNotAllowed = [
        'img','hr','br'
    ];

    protected $tagsNotAllowedSpecial = [
        'i'
    ];

    protected $mode;

    public function __construct($mode='display')
    {
        $this->mode = $mode;
    }

    public function getMode(){
        return $this->mode;
    }

    public function __invoke($item)
    {
        $output = '';
        $parameters = json_decode($item->getData()->getParameters(),true);
        $attributes = $item->getData()->getAttributes();
        $options = json_decode($item->getData()->getOptions(),true);


        if(array_key_exists('wrapper',$options)) {
            if(array_key_exists('outer',$options['wrapper'])) {
                $param = (array_key_exists('parameters',$options['wrapper']['outer']))
                    ?$options['wrapper']['outer']['parameters']
                    :[]
                ;
                $attr = (array_key_exists('attributes',$options['wrapper']['outer']))
                    ?$options['wrapper']['outer']['attributes']
                    :[]
                ;
                if('edit' === $this->getMode()) {
                    $attr['data-uid'] = $item->getData()->getUid();
                    $attr['data-wrapper'] = 'outer';
                    $attr['data-type'] = $item->getType();
                }

                $output .= sprintf('<%s',$param['html_tag']);

                if( ! empty($attr)) {
                    foreach($attr as $attrName=>$attrValue) {
                        if(is_string($attrValue)){
                            $attrCombined = $attrValue;
                        } elseif(is_array($attrValue)) {
                            $attrCombined = '';
                            foreach($attrValue as $partialValue){
                                $attrCombined .= sprintf(" %s",$partialValue);
                            }

                        }

                        $output .= sprintf(' %s="%s"',$attrName,trim($attrCombined));
                    }
                }

                if(in_array($param['html_tag'],$this->tagsNotAllowed)) {
                    $output .= ' /';
                }
                $output .= '>';
            }
        }

        if( ! empty($parameters) && array_key_exists('html_tag',$parameters)) {
            $output .= sprintf('<%s',$parameters['html_tag']);
            if('edit' === $this->getMode()) {
                $attributes['data-uid'] = $item->getData()->getUid();
                $attributes['data-wrapper'] = 'main';
                $attributes['data-type'] = $item->getType();
            }
            if( ! empty($attributes) && is_array($attributes)) {
                foreach($attributes as $attrName=>$attrValue) {
                    $attrCombined = '';
                    if(is_string($attrValue)){
                        $attrCombined = $attrValue;
                    } elseif(is_array($attrValue)) {
                        foreach($attrValue as $partialValue){
                            $attrCombined .= sprintf(" %s",$partialValue);
                        }

                    }
                    $output .= sprintf(' %s="%s"',$attrName,trim($attrCombined));
                }
            }

            if(in_array($parameters['html_tag'],$this->tagsNotAllowed)) {
                $output .= ' /';
            } elseif(in_array($parameters['html_tag'],$this->tagsNotAllowedSpecial)){
                $output .= sprintf("></%s>",$parameters['html_tag']);
            } else {
                $output .= '>';
            }

        }

        if(array_key_exists('wrapper',$options)) {
            if(array_key_exists('inner',$options['wrapper'])) {
                $param = (array_key_exists('parameters',$options['wrapper']['inner']))
                    ?$options['wrapper']['inner']['parameters']
                    :[]
                ;
                $attr = (array_key_exists('attributes',$options['wrapper']['inner']))
                    ?$options['wrapper']['inner']['attributes']
                    :[]
                ;
                if('edit' === $this->getMode()) {
                    $attr['data-uid'] = $item->getData()->getUid();
                    $attr['data-wrapper'] = 'inner';
                    $attr['data-type'] = $item->getType();
                }
                $output .= sprintf('<%s',$param['html_tag']);
                if( ! empty($attr)) {
                    foreach($attr as $attrName=>$attrValue) {
                        if(is_string($attrValue)){
                            $attrCombined = $attrValue;
                        } elseif(is_array($attrValue)) {
                            $attrCombined = '';
                            foreach($attrValue as $partialValue){
                                $attrCombined .= sprintf(" %s",$partialValue);
                            }

                        }
                        $output .= sprintf(' %s="%s"',$attrName,trim($attrCombined));
                    }
                }

                if( in_array($param['html_tag'],$this->tagsNotAllowed)) {
                    $output .= '/';
                }
                $output .= '>';
            }
        }

        return $output;
    }
}
