<?php

function labelCopy($nilai)
{
    return '<button id="copy" data-copy="' . $nilai . '"  class="btn btn-sm btn-outline-info" data-coreui-toggle="tooltip" data-coreui-placement="top" title="klik untuk copy">' . $nilai . '</button>';
}

function labelCopySuccess($nilai)
{
    return '<button id="no-shipping" class="btn btn-sm btn-outline-success" data-coreui-toggle="tooltip" data-coreui-placement="top" title="klik untuk tracking">' . $nilai . '</button>';
}

function labelDetail($nilai)
{
    return '<button id="detail" data-id="' . $nilai . '"  class="btn btn-sm btn-outline-warning" data-coreui-toggle="tooltip" data-coreui-placement="top" title="klik untuk detail">' . $nilai . '</button>';
}

function rupiah($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

function statusRole($nilai)
{
    return '<span id="copy" data-copy="' . $nilai . '"  class="badge badge-info">' . $nilai . '</span>';
}

function statusActive($nilai)
{
    return $nilai == 1 ? labelCopySuccess("Active") : labelDetail("Not Active");
}

function ribuan($nilai)
{
    return number_format($nilai, "2", ",", ".");
}

function statusApproved($nilai)
{
    if ($nilai == 1) {
        return '<span id="approved" class="badge badge-success">Diterima</span>';
    } else {
        return '<span id="approved" class="badge badge-danger">Pending</span>';
    }
}

function tanggalFull($nilai)
{
    return date('d-M-Y H:i:s', strtotime($nilai));
}

function tanggalIndo($nilai)
{
    return date('d-m-Y', strtotime($nilai));
}

function tanggal($nilai)
{
    return date('Y-m-d', strtotime($nilai));
}

function tanggalIndoFull($nilai)
{
    return date('d-m-Y H:i:s', strtotime($nilai));
}

function numberOnly($nilai)
{
    return preg_replace("/[^0-9]/", "", $nilai);
}

function getTahunFormat($nilai) : int
{
    $tahun = explode("-", $nilai);
    return $tahun[1];
}

function getBulanFormat($nilai) : int
{
    $tahun = explode("-", $nilai);
    return $tahun[0];
}