<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller;

/**
 * NotifyController Trait
 *
 * @package AppBundle\Controller
 */
trait NotifyControllerTrait
{
    /**
     * Top notification suffix
     *
     * @var string
     */
    private static $suffixTop = 'Top';

    /**
     * Right notification suffix
     *
     * @var string
     */
    private static $suffixRight = 'Right';

    /**
     * Success type notify
     *
     * @var string
     */
    private static $notifySuccess = 'success';

    /**
     * Info type notify
     *
     * @var string
     */
    private static $notifyInfo = 'info';

    /**
     * Warning type notify
     *
     * @var string
     */
    private static $notifyWarning = 'warning';

    /**
     * Error type notify
     *
     * @var string
     */
    private static $notifyError = 'error';

    /**
     * Send notification to view on top page
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function notifyViewOnTop(string $type, string $message): void
    {
        if (self::isValidNotifyType($type)) {
            $this->addFlash($type . self::$suffixTop, $message);
        }
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewSuccessOnTop(string $message): void
    {
        $this->notifyViewOnTop(self::$notifySuccess, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewInfoOnTop(string $message): void
    {
        $this->notifyViewOnTop(self::$notifyInfo, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewWarningOnTop(string $message): void
    {
        $this->notifyViewOnTop(self::$notifyWarning, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewErrorOnTop(string $message): void
    {
        $this->notifyViewOnTop(self::$notifyError, $message);
    }

    /**
     * Send notification to view on right in page
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function notifyViewOnRight(string $type, string $message): void
    {
        if (self::isValidNotifyType($type)) {
            $this->addFlash($type . self::$suffixRight, $message);
        }
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewSuccessOnRight(string $message): void
    {
        $this->notifyViewOnRight(self::$notifyError, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewInfoOnRight(string $message): void
    {
        $this->notifyViewOnRight(self::$notifyInfo, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewWarningOnRight(string $message): void
    {
        $this->notifyViewOnRight(self::$notifyWarning, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function notifyViewErrorOnRight(string $message): void
    {
        $this->notifyViewOnRight(self::$notifyError, $message);
    }

    /**
     * Get notify types available
     *
     * @return array
     */
    public static function getNotifyTypeAvailable(): array
    {
        return [
            self::$notifySuccess,
            self::$notifyInfo,
            self::$notifyWarning,
            self::$notifyError,
        ];
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function isValidNotifyType(string $type): bool
    {
        return in_array($type, self::getNotifyTypeAvailable());
    }
}
