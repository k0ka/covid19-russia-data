<?php

class Regions {
    private $_idToName = array();
    private $_nameToId = array();

    public function __construct()
    {
        $this->AddRegion('77', 'Москва');
        $this->AddRegion('78', 'Санкт-Петербург');
        $this->AddRegion('22', 'Алтайский край');
        $this->AddRegion('28', 'Амурская область');
        $this->AddRegion('29', 'Архангельская область');
        $this->AddRegion('30', 'Астраханская область');
        $this->AddRegion('31', 'Белгородская область');
        $this->AddRegion('32', 'Брянская область');
        $this->AddRegion('33', 'Владимирская область');
        $this->AddRegion('34', 'Волгоградская область');
        $this->AddRegion('35', 'Вологодская область');
        $this->AddRegion('36', 'Воронежская область');
        $this->AddRegion('79', 'Еврейская автономная область');
        $this->AddRegion('75', 'Забайкальский край');
        $this->AddRegion('37', 'Ивановская область');
        $this->AddRegion('38', 'Иркутская область');
        $this->AddRegion('07', 'Кабардино-Балкарская Республика');
        $this->AddRegion('39', 'Калининградская область');
        $this->AddRegion('40', 'Калужская область');
        $this->AddRegion('41', 'Камчатский край');
        $this->AddRegion('09', 'Карачаево-Черкесская Республика');
        $this->AddRegion('42', 'Кемеровская область');
        $this->AddRegion('43', 'Кировская область');
        $this->AddRegion('44', 'Костромская область');
        $this->AddRegion('23', 'Краснодарский край');
        $this->AddRegion('24', 'Красноярский край');
        $this->AddRegion('45', 'Курганская область');
        $this->AddRegion('46', 'Курская область');
        $this->AddRegion('47', 'Ленинградская область');
        $this->AddRegion('48', 'Липецкая область');
        $this->AddRegion('49', 'Магаданская область');
        $this->AddRegion('50', 'Московская область');
        $this->AddRegion('51', 'Мурманская область');
        $this->AddRegion('83', 'Ненецкий автономный округ');
        $this->AddRegion('52', 'Нижегородская область');
        $this->AddRegion('53', 'Новгородская область');
        $this->AddRegion('54', 'Новосибирская область');
        $this->AddRegion('55', 'Омская область');
        $this->AddRegion('56', 'Оренбургская область');
        $this->AddRegion('57', 'Орловская область');
        $this->AddRegion('58', 'Пензенская область');
        $this->AddRegion('59', 'Пермский край');
        $this->AddRegion('25', 'Приморский край');
        $this->AddRegion('60', 'Псковская область');
        $this->AddRegion('01', 'Республика Адыгея (Адыгея)');
        $this->AddRegion('04', 'Республика Алтай');
        $this->AddRegion('02', 'Республика Башкортостан');
        $this->AddRegion('03', 'Республика Бурятия');
        $this->AddRegion('05', 'Республика Дагестан');
        $this->AddRegion('06', 'Республика Ингушетия');
        $this->AddRegion('08', 'Республика Калмыкия');
        $this->AddRegion('10', 'Республика Карелия');
        $this->AddRegion('11', 'Республика Коми');
        $this->AddRegion('91', 'Республика Крым');
        $this->AddRegion('12', 'Республика Марий Эл');
        $this->AddRegion('13', 'Республика Мордовия');
        $this->AddRegion('14', 'Республика Саха (Якутия)');
        $this->AddRegion('15', 'Республика Северная Осетия - Алания');
        $this->AddRegion('16', 'Республика Татарстан (Татарстан)');
        $this->AddRegion('17', 'Республика Тыва');
        $this->AddRegion('19', 'Республика Хакасия');
        $this->AddRegion('61', 'Ростовская область');
        $this->AddRegion('62', 'Рязанская область');
        $this->AddRegion('63', 'Самарская область');
        $this->AddRegion('64', 'Саратовская область');
        $this->AddRegion('65', 'Сахалинская область');
        $this->AddRegion('66', 'Свердловская область');
        $this->AddRegion('92', 'Севастополь');
        $this->AddRegion('67', 'Смоленская область');
        $this->AddRegion('26', 'Ставропольский край');
        $this->AddRegion('68', 'Тамбовская область');
        $this->AddRegion('69', 'Тверская область');
        $this->AddRegion('70', 'Томская область');
        $this->AddRegion('71', 'Тульская область');
        $this->AddRegion('72', 'Тюменская область');
        $this->AddRegion('18', 'Удмуртская Республика');
        $this->AddRegion('73', 'Ульяновская область');
        $this->AddRegion('27', 'Хабаровский край');
        $this->AddRegion('86', 'Ханты-Мансийский автономный округ - Югра');
        $this->AddRegion('74', 'Челябинская область');
        $this->AddRegion('20', 'Чеченская Республика');
        $this->AddRegion('21', 'Чувашская Республика - Чувашия');
        $this->AddRegion('87', 'Чукотский автономный округ');
        $this->AddRegion('89', 'Ямало-Ненецкий автономный округ');
        $this->AddRegion('76', 'Ярославская область');

        $this->AddRegionSynonym('16', 'Республика Татарстан');
        $this->AddRegionSynonym('21', 'Республика Чувашия');
        $this->AddRegionSynonym('86', 'Ханты-Мансийский АО');
        $this->AddRegionSynonym('01', 'Республика Адыгея');
        $this->AddRegionSynonym('15', 'Республика Северная Осетия — Алания');
    }

    /**
     * Fills internal arrays
     *
     * @param $id
     * @param $region
     */
    private function AddRegion($id, $region){
        $id = intval($id);
        $this->_idToName[$id] = $region;
        $this->_nameToId[$region] = $id;
    }

    /**
     * Fills internal arrays
     *
     * @param $id
     * @param $region
     */
    private function AddRegionSynonym($id, $region){
        $id = intval($id);
        $this->_nameToId[$region] = $id;
    }

    /**
     * Returns region name by id
     *
     * @param $regionName
     * @return mixed
     * @throws Exception
     */
    public function GetRegionId($regionName){
        if(!isset($this->_nameToId[$regionName])){
            throw new Exception("Unknown region: $regionName");
        }

        return $this->_nameToId[$regionName];
    }
}
