<?php

declare(strict_types = 1);

namespace NAttreid\GoogleApi\Hooks;

/**
 * Interface IConfigurator
 *
 * @property string $googleAnalyticsClientId Id google analytics
 * @property string $googleWebMasterKey overovaci klic pro webmaster tools
 * @property string $googleMerchantKey overovaci klic pro google merchant
 * @property string $googleAdWordsConversionId adWords conversion id
 * @property string $googleAdWordsConversionLabel adWords conversion label
 *
 * @author Attreid <attreid@gmail.com>
 */
interface IConfigurator extends \NAttreid\Cms\Configurator\IConfigurator
{

}
