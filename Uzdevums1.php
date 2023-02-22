<?php

$theSumSingle = calculateRoundValue($kWh_paterins, $calc_def_vars, $voltage_level, $amperage, $IAA_lielums, $vatVal, $oikSingleVal, $oikSingleVal, $input, 0);
$theSumSingleP1 = calculateRoundValue($kWh_paterins, $calc_def_vars, $voltage_level, $amperage, $IAA_lielums, $vatVal, $oikSingleVal, $oikSingleValP1, $input, 1);
$theSumSingleP2 = calculateRoundValue($kWh_paterins, $calc_def_vars, $voltage_level, $amperage, $IAA_lielums, $vatVal, $oikSingleVal, $oikSingleValP2, $input, 2);

if ($isSecondEnabled) {
    $theSumSingle2 = calculateRoundValue($kWh_paterins, $calc_def_vars2, $voltage_level, $amperage, $IAA_lielums, $vatVal2, $oikSingleVal2, $oikSingleVal, $input, 0);
    $theSumSingleP12 = calculateRoundValue($kWh_paterins, $calc_def_vars2, $voltage_level, $amperage, $IAA_lielums, $vatVal2, $oikSingleVal2, $oikSingleValP1, $input, 1);
    $theSumSingleP22 = calculateRoundValue($kWh_paterins, $calc_def_vars2, $voltage_level, $amperage, $IAA_lielums, $vatVal2, $oikSingleVal2, $oikSingleValP22, $input, 2);
}

function calculateRoundValue
    (
        float  $kWh_paterins,
        array  $calc_def_vars,
        string $voltage_level,
        float  $amperage,
        float  $IAA_lielums,
        float  $vatVal,
        float  $oikSingleVal,
        float  $oikSingleValP,
        array  $input,
        int    $index
    ): float
    {
        return round(($kWh_paterins * $calc_def_vars['S6' . $voltage_level . $amperage . '_piegade'][$index] +
                $calc_def_vars['S6' . $voltage_level . $amperage . '_abonesana'][$index] / 12 * $IAA_lielums +
                (isset($input['no-0IK']) ? $oikSingleVal : $kWh_paterins * $calc_def_vars['OIK_kogeneracija']) +
                (isset($input['no-0IK']) ? $oikSingleVal : $kWh_paterins * $calc_def_vars['OIK_AER']) +
                ($oikSingleValP / 12 * $IAA_lielums)) * ($vatVal), 2);
    }