<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Nacos\Model;

use Hyperf\Nacos\Lib\NacosConfig;

class ConfigModel extends AbstractModel
{
    public $tenant;

    public $dataId;

    public $group;

    public $content;

    public $type = 'json';

    public $required_field = [
        'dataId',
    ];

    public function __construct($config = [])
    {
        parent::__construct($config);
        /** @var NacosConfig $nacos_config */
        $nacos_config = make(NacosConfig::class);
        $val = $nacos_config->get($this);
        if ($val) {
            $this->content = $val;
        }
    }

    public function parser($config_origin)
    {
        switch ($this->type) {
            case 'json':
                return is_array($config_origin) ? $config_origin : json_decode($config_origin, true);
            case 'yml':
                return yaml_parse($config_origin);
            case 'xml':
                return xml2array($config_origin);
            default:
                return $config_origin;
        }
    }

    public function getValue()
    {
        return $this->parser($this->content);
    }
}
