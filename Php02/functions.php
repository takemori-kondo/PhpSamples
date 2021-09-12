<?php
/**
 * TODO list sample's functions.php.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
namespace Php02;

function strUtcToStrTokyo($strUtcDate)
{
    $oDate = new \DateTime($strUtcDate, new \DateTimeZone('UTC'));
    $oDate->setTimezone(new \DateTimeZone('Asia/Tokyo'));
    return $oDate->format('Y-m-d H:i:s');
}
