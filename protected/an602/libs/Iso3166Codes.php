<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 */

namespace an602\libs;

use Yii;

/**
 * Map of codes from ISO 3166.
 * Credits: https://github.com/julien-c/iso3166/blob/master/src/Codes.php
 *
 * @author Sebastian Stumpf
 *
 */
class Iso3166Codes
{
    public static $countries = [
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua and Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BQ' => 'Bonaire, Saint Eustatius and Saba',
        'BA' => 'Bosnia and Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'VG' => 'British Virgin Islands',
        'BN' => 'Brunei',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CW' => 'Curacao',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'CD' => 'Democratic Republic of the Congo',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island and McDonald Islands',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'CI' => 'Ivory Coast',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'XK' => 'Kosovo',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Laos',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'KP' => 'North Korea',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'CG' => 'Republic of the Congo',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russia',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and the Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome and Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SX' => 'Sint Maarten',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'KR' => 'South Korea',
        'SS' => 'South Sudan',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syria',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks and Caicos Islands',
        'TV' => 'Tuvalu',
        'VI' => 'U.S. Virgin Islands',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Minor Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VA' => 'Vatican',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'WF' => 'Wallis and Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe'
    ];

    public static $phoneCodes = [
        'AF' => '93',
        'AX' => '358',
        'AL' => '355',
        'DZ' => '213',
        'AS' => '1684',
        'AD' => '376',
        'AO' => '244',
        'AQ' => '672',
        'AG' => '1268',
        'AR' => '54',
        'AM' => '374',
        'AW' => '297',
        'AU' => '61',
        'AT' => '43',
        'AZ' => '994',
        'BS' => '1242',
        'BH' => '973',
        'BD' => '880',
        'BB' => '1246',
        'BY' => '375',
        'BE' => '32',
        'BZ' => '501',
        'BJ' => '229',
        'BM' => '1441',
        'BT' => '975',
        'BO' => '591',
        'BQ' => '5997',
        'BA' => '387',
        'BW' => '267',
        'BR' => '55',
        'IO' => '246',
        'BN' => '673',
        'BG' => '359',
        'BF' => '226',
        'BI' => '257',
        'KH' => '855',
        'CM' => '237',
        'CA' => '1',
        'CV' => '238',
        'KY' => '1345',
        'CF' => '236',
        'TD' => '235',
        'CL' => '56',
        'CN' => '86',
        'CX' => '61',
        'CC' => '61891',
        'CO' => '57',
        'KM' => '269',
        'CG' => '242',
        'CD' => '243',
        'CK' => '682',
        'CR' => '506',
        'HR' => '385',
        'CU' => '53',
        'CW' => '599',
        'CY' => '357',
        'CZ' => '420',
        'DK' => '45',
        'DJ' => '253',
        'DM' => '1767',
        'EC' => '593',
        'EG' => '20',
        'SV' => '503',
        'GQ' => '240',
        'ER' => '291',
        'EE' => '372',
        'ET' => '251',
        'FK' => '500',
        'FO' => '298',
        'FJ' => '679',
        'FI' => '358',
        'FR' => '33',
        'GF' => '594',
        'PF' => '689',
        'TF' => '596',
        'GA' => '241',
        'GM' => '220',
        'GE' => '995',
        'DE' => '49',
        'GH' => '233',
        'GI' => '350',
        'GR' => '30',
        'GL' => '299',
        'GD' => '1473',
        'GP' => '590',
        'GU' => '1671',
        'GT' => '502',
        'GG' => '441481',
        'GN' => '224',
        'GW' => '245',
        'GY' => '592',
        'HT' => '509',
        'HN' => '504',
        'HK' => '852',
        'HU' => '36',
        'IS' => '354',
        'IN' => '91',
        'ID' => '62',
        'IR' => '98',
        'IQ' => '964',
        'IE' => '353',
        'IM' => '441624',
        'IL' => '972',
        'IT' => '39',
        'CI' => '225',
        'JM' => '1876',
        'JP' => '81',
        'JE' => '441534',
        'JO' => '962',
        'KZ' => '7',
        'KE' => '254',
        'KI' => '686',
        'KP' => '850',
        'KR' => '82',
        'XK' => '383',
        'KW' => '965',
        'KG' => '996',
        'LA' => '856',
        'LV' => '371',
        'LB' => '961',
        'LS' => '266',
        'LR' => '231',
        'LY' => '218',
        'LI' => '423',
        'LT' => '370',
        'LU' => '352',
        'MO' => '853',
        'MK' => '389',
        'MG' => '261',
        'MW' => '265',
        'MY' => '60',
        'MV' => '960',
        'ML' => '223',
        'MT' => '356',
        'MH' => '692',
        'MQ' => '596',
        'MR' => '222',
        'MU' => '230',
        'YT' => '269',
        'MX' => '52',
        'FM' => '691',
        'MD' => '373',
        'MC' => '377',
        'MN' => '976',
        'ME' => '382',
        'MS' => '1664',
        'MA' => '212',
        'MZ' => '258',
        'MM' => '95',
        'NA' => '264',
        'NR' => '674',
        'NP' => '977',
        'NL' => '31',
        'AN' => '599',
        'NC' => '687',
        'NZ' => '64',
        'NI' => '505',
        'NE' => '227',
        'NG' => '234',
        'NU' => '683',
        'NF' => '672',
        'MP' => '1670',
        'NO' => '47',
        'OM' => '968',
        'PK' => '92',
        'PW' => '680',
        'PS' => '970',
        'PA' => '507',
        'PG' => '675',
        'PY' => '595',
        'PE' => '51',
        'PH' => '63',
        'PN' => '64',
        'PL' => '48',
        'PT' => '351',
        'QA' => '974',
        'RE' => '262',
        'RO' => '40',
        'RU' => '7',
        'RW' => '250',
        'BL' => '590',
        'SH' => '290',
        'KN' => '1869',
        'LC' => '1758',
        'MF' => '590',
        'PM' => '508',
        'VC' => '1784',
        'WS' => '685',
        'SM' => '378',
        'ST' => '239',
        'SA' => '966',
        'SN' => '221',
        'RS' => '381',
        'SC' => '248',
        'SL' => '232',
        'SG' => '65',
        'SX' => '1721',
        'SK' => '421',
        'SI' => '386',
        'SB' => '677',
        'SO' => '252',
        'ZA' => '27',
        'GS' => '500',
        'SS' => '211',
        'ES' => '34',
        'LK' => '94',
        'SD' => '249',
        'SR' => '597',
        'SJ' => '47',
        'SZ' => '268',
        'SE' => '46',
        'CH' => '41',
        'SY' => '963',
        'TW' => '886',
        'TJ' => '992',
        'TZ' => '255',
        'TH' => '66',
        'TL' => '670',
        'TG' => '228',
        'TK' => '690',
        'TO' => '676',
        'TT' => '1868',
        'TN' => '216',
        'TR' => '90',
        'TM' => '993',
        'TC' => '1649',
        'TV' => '688',
        'UG' => '256',
        'UA' => '380',
        'AE' => '971',
        'GB' => '44',
        'US' => '1',
        'UY' => '598',
        'UZ' => '998',
        'VU' => '678',
        'VA' => '379',
        'VE' => '58',
        'VN' => '84',
        'VI' => '1340',
        'VG' => '1284',
        'WF' => '681',
        'EH' => '212',
        'YE' => '967',
        'ZM' => '260',
        'ZW' => '263'
    ];

    public static function country($code, $translate = true)
    {
        return \Locale::getDisplayRegion('_' . $code, $translate ? Yii::$app->language : 'en-US');
    }

    public static function phoneCode($code)
    {
        return (isset(static::$phoneCodes[strtoupper($code)])) ? static::$phoneCodes[strtoupper($code)] : 'N/A';
    }

    public static function isValid($code)
    {
        return isset(static::$countries[strtoupper($code)]);
    }
}
