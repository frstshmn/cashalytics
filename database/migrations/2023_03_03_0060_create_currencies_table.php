<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('currencies')) { return; }

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5);
            $table->string('name', 50);
            $table->string('flag', 10)->default("");
            $table->timestamps();
        });

        DB::table('currencies')->insert(
            array(
                ["code" => "AED", "name" =>	"UAE Dirham"],
                ["code" => "ALL", "name" =>	"Albanian Lek"],
                ["code" => "AMD", "name" =>	"Armenian Dram"],
                ["code" => "ANG", "name" =>	"Antillian Guilder"],
                ["code" => "AOA", "name" =>	"Angolan Kwanza"],
                ["code" => "ARS", "name" =>	"Nuevo Argentine Peso"],
                ["code" => "AUD", "name" =>	"Australian Dollar"],
                ["code" => "AWG", "name" =>	"Aruban Guilder"],
                ["code" => "AZN", "name" =>	"Azerbaijani manat"],
                ["code" => "BAM", "name" =>	"Bosnia and Herzegovina Convertible Marks"],
                ["code" => "BBD", "name" =>	"Barbados Dollar"],
                ["code" => "BDT", "name" =>	"Bangladesh Taka"],
                ["code" => "BGN", "name" =>	"New Bulgarian Lev"],
                ["code" => "BHD", "name" =>	"Bahraini Dinar"],
                ["code" => "BMD", "name" =>	"Bermudian Dollar"],
                ["code" => "BND", "name" =>	"Brunei Dollar"],
                ["code" => "BOB", "name" =>	"Bolivia Boliviano"],
                ["code" => "BRL", "name" =>	"Brazilian Real"],
                ["code" => "BSD", "name" =>	"Bahamian Dollar"],
                ["code" => "BWP", "name" =>	"Botswana Pula"],
                ["code" => "BYN", "name" =>	"New Belarusian Ruble"],
                ["code" => "BZD", "name" =>	"Belize Dollar"],
                ["code" => "CAD", "name" =>	"Canadian Dollar"],
                ["code" => "CHF", "name" =>	"Swiss Franc"],
                ["code" => "CLP", "name" =>	"Chilean Peso"],
                ["code" => "CNY", "name" =>	"Yuan Renminbi"],
                ["code" => "COP", "name" =>	"Colombian Peso"],
                ["code" => "CRC", "name" =>	"Costa Rican Colon"],
                ["code" => "CUP", "name" =>	"Cuban Peso"],
                ["code" => "CVE", "name" =>	"Cape Verdi Escudo"],
                ["code" => "CZK", "name" =>	"Czech Koruna"],
                ["code" => "DJF", "name" =>	"Djibouti Franc"],
                ["code" => "DKK", "name" =>	"Danish Krone"],
                ["code" => "DOP", "name" =>	"Dominican Republic Peso"],
                ["code" => "DZD", "name" =>	"Algerian Dinar"],
                ["code" => "EGP", "name" =>	"Egyptian Pound"],
                ["code" => "ETB", "name" =>	"Ethiopian Birr"],
                ["code" => "EUR", "name" =>	"Euro"],
                ["code" => "FJD", "name" =>	"Fiji Dollar"],
                ["code" => "FKP", "name" =>	"Falkland Islands Pound"],
                ["code" => "GBP", "name" =>	"Pound Sterling"],
                ["code" => "GEL", "name" =>	"Georgian Lari"],
                ["code" => "GHS", "name" =>	"Ghanaian Cedi (3rd)"],
                ["code" => "GIP", "name" =>	"Gibraltar Pound"],
                ["code" => "GMD", "name" =>	"Gambia Delasi"],
                ["code" => "GNF", "name" =>	"Guinea Franc"],
                ["code" => "GTQ", "name" =>	"Guatemala Quetzal"],
                ["code" => "GYD", "name" =>	"Guyanese Dollar"],
                ["code" => "HKD", "name" =>	"Hong Kong Dollar"],
                ["code" => "HNL", "name" =>	"Honduras Lempira"],
                ["code" => "HRK", "name" =>	"Croatia Kuna"],
                ["code" => "HTG", "name" =>	"Haitian Gourde"],
                ["code" => "HUF", "name" =>	"Hungarian Forint"],
                ["code" => "IDR", "name" =>	"Indonesian Rupiah"],
                ["code" => "ILS", "name" =>	"New Israeli Scheqel"],
                ["code" => "INR", "name" =>	"Indian Rupee"],
                ["code" => "IQD", "name" =>	"Iraqi Dinar"],
                ["code" => "ISK", "name" =>	"Iceland Krona"],
                ["code" => "JMD", "name" =>	"Jamaican Dollar"],
                ["code" => "JOD", "name" =>	"Jordanian Dinar"],
                ["code" => "JPY", "name" =>	"Japanese Yen"],
                ["code" => "KES", "name" =>	"Kenyan Shilling"],
                ["code" => "KGS", "name" =>	"Kyrgyzstan Som"],
                ["code" => "KHR", "name" =>	"Cambodia Riel"],
                ["code" => "KMF", "name" =>	"Comoro Franc"],
                ["code" => "KRW", "name" =>	"South-Korean Won"],
                ["code" => "KWD", "name" =>	"Kuwaiti Dinar"],
                ["code" => "KYD", "name" =>	"Cayman Islands Dollar"],
                ["code" => "KZT", "name" =>	"Kazakhstani Tenge"],
                ["code" => "LAK", "name" =>	"Laos Kip"],
                ["code" => "LBP", "name" =>	"Lebanese Pound"],
                ["code" => "LKR", "name" =>	"Sri Lanka Rupee"],
                ["code" => "LYD", "name" =>	"Libyan Dinar"],
                ["code" => "MAD", "name" =>	"Moroccan Dirham"],
                ["code" => "MDL", "name" =>	"Moldovia Leu"],
                ["code" => "MKD", "name" =>	"Macedonian Denar"],
                ["code" => "MMK", "name" =>	"Myanmar Kyat"],
                ["code" => "MNT", "name" =>	"Mongolia Tugrik"],
                ["code" => "MOP", "name" =>	"Macau Pataca"],
                ["code" => "MRU", "name" =>	"Mauritania Ouguiya"],
                ["code" => "MUR", "name" =>	"Mauritius Rupee"],
                ["code" => "MVR", "name" =>	"Maldives Rufiyaa"],
                ["code" => "MWK", "name" =>	"Malawi Kwacha"],
                ["code" => "MXN", "name" =>	"Mexican Peso"],
                ["code" => "MYR", "name" =>	"Malaysian Ringgit"],
                ["code" => "MZN", "name" =>	"Mozambican Metical"],
                ["code" => "NAD", "name" =>	"Namibian Dollar"],
                ["code" => "NGN", "name" =>	"Nigerian Naira"],
                ["code" => "NIO", "name" =>	"Nicaragua Cordoba Oro"],
                ["code" => "NOK", "name" =>	"Norwegian Krone"],
                ["code" => "NPR", "name" =>	"Nepalese Rupee"],
                ["code" => "NZD", "name" =>	"New Zealand Dollar"],
                ["code" => "OMR", "name" =>	"Rial Omani"],
                ["code" => "PAB", "name" =>	"Panamanian Balboa"],
                ["code" => "PEN", "name" =>	"Peruvian Nuevo Sol"],
                ["code" => "PGK", "name" =>	"New Guinea Kina"],
                ["code" => "PHP", "name" =>	"Philippine Peso"],
                ["code" => "PKR", "name" =>	"Pakistan Rupee"],
                ["code" => "PLN", "name" =>	"New Polish Zloty"],
                ["code" => "PYG", "name" =>	"Paraguay Guarani"],
                ["code" => "QAR", "name" =>	"Qatari Rial"],
                ["code" => "RON", "name" =>	"New Romanian Lei"],
                ["code" => "RSD", "name" =>	"Serbian Dinar"],
                ["code" => "RUB", "name" =>	"Russian Ruble"],
                ["code" => "RWF", "name" =>	"Rwanda Franc"],
                ["code" => "SAR", "name" =>	"Saudi Riyal"],
                ["code" => "SBD", "name" =>	"Solomon Island Dollar"],
                ["code" => "SCR", "name" =>	"Seychelles Rupee"],
                ["code" => "SEK", "name" =>	"Swedish Krone"],
                ["code" => "SGD", "name" =>	"Singapore Dollar"],
                ["code" => "SHP", "name" =>	"St. Helena Pound"],
                ["code" => "SLL", "name" =>	"Sierra Leone Leone"],
                ["code" => "SOS", "name" =>	"Somalia Shilling"],
                ["code" => "SRD", "name" =>	"Surinamese dollar"],
                ["code" => "STN", "name" =>	"Sao Tome & Principe Dobra"],
                ["code" => "SVC", "name" =>	"El Salvador Colón"],
                ["code" => "SZL", "name" =>	"Swaziland Lilangeni"],
                ["code" => "THB", "name" =>	"Thai Baht"],
                ["code" => "TND", "name" =>	"Tunisian Dinar"],
                ["code" => "TOP", "name" =>	"Tonga Pa'anga"],
                ["code" => "TRY", "name" =>	"New Turkish Lira"],
                ["code" => "TTD", "name" =>	"Trinidad & Tobago Dollar"],
                ["code" => "TWD", "name" =>	"New Taiwan Dollar"],
                ["code" => "TZS", "name" =>	"Tanzanian Shilling"],
                ["code" => "UAH", "name" =>	"Ukraine Hryvnia"],
                ["code" => "UGX", "name" =>	"Uganda Shilling"],
                ["code" => "USD", "name" =>	"US Dollars"],
                ["code" => "UYU", "name" =>	"Peso Uruguayo"],
                ["code" => "UZS", "name" =>	"Uzbekistani Som"],
                ["code" => "VEF", "name" =>	"Venezuelan Bolívar"],
                ["code" => "VND", "name" =>	"Vietnamese New Dong"],
                ["code" => "VUV", "name" =>	"Vanuatu Vatu"],
                ["code" => "WST", "name" =>	"Samoan Tala"],
                ["code" => "XAF", "name" =>	"CFA Franc BEAC"],
                ["code" => "XCD", "name" =>	"East Caribbean Dollar"],
                ["code" => "XOF", "name" =>	"CFA Franc BCEAO"],
                ["code" => "XPF", "name" =>	"CFP Franc"],
                ["code" => "YER", "name" =>	"Yemeni Rial"],
                ["code" => "ZAR", "name" =>	"South African Rand"],
                ["code" => "ZMW", "name" =>	"Zambian Kwacha"]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
