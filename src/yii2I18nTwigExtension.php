<?php
/**
 * Created by PhpStorm.
 * User: vladimir.ardelean
 * Date: 2019-07-16
 * Time: 16:00
 */

class yii2I18nTwigExtension
{
    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('trans', 'translateText'),
        );
    }
    
    public function translateText($value) {
        return Yii::t($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'yii2I18nTwig';
    }
}

class_alias('Yii2_Twig_Extensions_Extension_I18n', 'Twig\Extensions\TwigI18nExtension', false);