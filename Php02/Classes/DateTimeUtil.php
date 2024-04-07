<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php02\Classes;

class DateTimeUtil
{
    /**
     * Utc string to Asia/Tokyo string 
     *
     * @param string $strUtcDate Utc string.
     *
     * @return string
     */
    public static function strUtcToStrTokyo($strUtcDate)
    {
        $oDate = new \DateTime($strUtcDate, new \DateTimeZone('UTC'));
        $oDate->setTimezone(new \DateTimeZone('Asia/Tokyo'));
        return $oDate->format('Y-m-d H:i:s');
    }
}
