<?php
namespace Twig\Extensions;

use \yii\twig\Extension;

class yii2I18nTwigExtension extends Extension
{
    
    public function __construct(array $uses = [])
    {
        //$this->registerTranslate();
        parent::__construct($uses);
    }

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
            new \Twig_SimpleFilter('trans', [$this, 'translate']),
            new \Twig_SimpleFilter('transchoice', [$this, 'transchoice']),
            new \Twig_SimpleFilter('currency', [$this, 'currency']),
        );
    }
    
    public function translate($value) {
        return \Yii::t('app',$value);
    }

    public function transchoice($value) {
        return Yii::t($value);
    }

    public function currency($value,$currency,$separator,$decimal) {
        return number_format($value,2,$decimal,$separator);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    { 
        return 'yii2I18nTwigExtension';
    }

    protected function registerTranslate()
    {
        $function = new \Twig_SimpleFunction('translate', function ($params) {
            if (!is_array($params) || (0 == count($params))) {
                return null;
            }
            $languages = array_keys($params);
            array_walk($languages, function(&$value){
                $value = strtolower($value);
            });
            $params = array_combine(
                $languages,
                array_values($params)
            );
            if (empty($params['en'])) {
                $params['en'] = array_values($params)[0];
            }
            // app language
            $language = 'en';
            if (isset($params[$language])) {
                return htmlspecialchars($params[$language]);
            }
            return null;
        }, ['is_safe' => ['html']]);
        var_dump(\Yii::$app->get('view'));die;
        (\Yii::$app->view)->addFunctions([$function]);
    }
}