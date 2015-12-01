<?php
/**
 * User: khaled
 * Date: 6/3/15 at 3:58 PM
 */

namespace Common\View\Helper;


use Zend\View\Helper\AbstractHelper;

class DisplayMessage extends AbstractHelper
{

    const MSG_SUCCESS = 'success';
    const MSG_DANGER = 'danger';
    const MSG_WARNING = 'warning';
    const MSG_INFO = 'info';

    public function __invoke($body, $typeAlert)
    {

        switch ($typeAlert) {
            case self::MSG_SUCCESS:
                return sprintf("<div class='alert alert-success'><p>%s</p></div>", $body);
                break;

            case self::MSG_DANGER:
                return sprintf("<div class='alert alert-danger'><p>%s</p></div>", $body);
                break;

            case self::MSG_WARNING:
                return sprintf("<div class='alert alert-warning'><p>%s</p></div>", $body);
                break;

            case self::MSG_INFO:
                return sprintf("<div class='alert alert-info'><p>%s</p></div>", $body);
                break;

            default:
                return null;
                break;
        }

    }

}