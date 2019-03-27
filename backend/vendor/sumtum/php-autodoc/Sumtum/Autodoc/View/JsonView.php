<?php
/**
 * This file is part of the php-autodoc package.
 */
namespace Sumtum\Autodoc\View;

/**
 * @license http://opensource.org/licenses/bsd-license.php The BSD License
 * @author  Sumit Saha <sumit.analyzen@gmail.com>
 */
class JsonView extends BaseView
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $data     = json_encode($this->st_data, JSON_FORCE_OBJECT);

        $response = new \Sumtum\Autodoc\Response();
        $response->setContentType('application/json');
        $response->closeConection();
        $response->send($data);
    }
}
