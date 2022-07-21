function getId(id) {
    return document.getElementById(id);
}

function getName(name) {
    return document.getElementsByName(name);
}

function getData(el, data) {
    return el.getAttribute(data);
}

function getDataSelected(id, data) {
    let e = document.getElementById(id);
    console.log(e);
    var option = e.options[e.selectedIndex];
    return option.getAttribute(data);
}

function getButtonText(text) {
    copyTextToClipboard(text);
}

function appendSpan(id, value) {
    let node = document.createElement("span");
    let textNode = document.createTextNode(value);
    node.setAttribute("class", "btn btn-sm btn-outline-info");
    node.appendChild(textNode);
    return getId(id).appendChild(node);
}

function appendSpanStatus(id, value) {
    let node = document.createElement("span");
    let textNode = document.createTextNode(value);
    value != "AKTIF"
        ? node.setAttribute("class", "btn btn-sm btn-outline-danger btn-cus")
        : node.setAttribute("class", "btn btn-sm btn-outline-success btn-cus");
    node.appendChild(textNode);
    return getId(id).appendChild(node);
}

function setSelected(id, value) {
    value = value == null ? "" : value;
    getId(id).value = value;
    return getId(id).dispatchEvent(new Event("change"));
}

function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.style.position = "fixed";
    textArea.style.top = 0;
    textArea.style.left = 0;

    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = "2em";
    textArea.style.height = "2em";

    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;

    // Clean up any borders.
    textArea.style.border = "none";
    textArea.style.outline = "none";
    textArea.style.boxShadow = "none";

    // Avoid flash of the white box if rendered for any reason.
    textArea.style.background = "transparent";

    textArea.value = text;

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        console.log("Copying text command was " + msg);
    } catch (err) {
        console.log("Oops, unable to copy");
    }

    document.body.removeChild(textArea);
}

function capitalize(str) {
    return (str + "").replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function tanggalIndo(tanggal) {
    return moment(tanggal, "DD-MM-YYYY").format("DD-MMMM-YYYY");
}

function tglFormatIndo(tanggal) {
    return moment(tanggal, "YYYY-MM-DD").format("DD-MM-YYYY");
}

function tanggalTrans(tanggal) {
    return moment(tanggal, "YYYY-MM-DD").format("YYYY-MM-DD");
}

function getDropdownTransaksi(
    url,
    id,
    method = "get",
    kode = null,
    value = null
) {
    $.ajax({
        url: url,
        method: method,
        data: { kode: kode },
        success: function (data) {
            // console.log(data);
            $("#" + id).empty();
            $("#" + id).append('<option value="">- Pilih -</option>');

            $.each(data.result.list, function (key, value) {
                $("#" + id).append(
                    '<option value="' +
                        value.nama.trim() +
                        '" data-kode="' +
                        value.kode +
                        '">' +
                        value.nama +
                        "</option>"
                );
            });

            if (id) {
                $("#" + id).select2({
                    placeholder: "--pilih " + id + "--",
                    width: "100%",
                    allowClear: true,
                });
            }

            if (value) {
                setSelected(id, value);
            }
        },
    });
}

function getDropdown(url, id, method = "get", kode = null, value = null) {
    $.ajax({
        url: url,
        method: method,
        data: { kode: kode },
        success: function (data) {
            // console.log(data);
            $("#" + id).empty();
            $("#" + id).append('<option value="">- Pilih -</option>');

            $.each(data.result.list, function (key, value) {
                $("#" + id).append(
                    '<option value="' +
                        value.kode.trim() +
                        '" data-nama="' +
                        value.nama +
                        '">' +
                        value.nama +
                        "</option>"
                );
            });

            if (id) {
                $("#" + id).select2({
                    placeholder: "--pilih " + id + "--",
                    width: "100%",
                    allowClear: true,
                });
            }

            if (value) {
                setSelected(id, value);
            }
        },
    });
}

function getDropdownRegional(
    url,
    id,
    method = "get",
    kode = null,
    value = null
) {
    $.ajax({
        url: url,
        method: method,
        data: { kode: kode },
        success: function (data) {
            $("#" + id).empty();
            $("#" + id).append('<option value="">- Pilih -</option>');

            $.each(data.result.list, function (key, value) {
                $("#" + id).append(
                    '<option value="' +
                        value.kode.trim() +
                        '" data-provincy="' +
                        value.kode_provincy +
                        '">' +
                        value.nama +
                        "," +
                        value.nama_provincy +
                        "</option>"
                );
            });

            if (id) {
                $("#" + id).select2({
                    placeholder: "--pilih " + id + "--",
                    minimumInputLength: 3,
                    width: "100%",
                    allowClear: true,
                });
            }

            if (value) {
                setSelected(id, value);
            }
        },
    });
}

function getDropdownDistrict(
    url,
    id,
    method = "get",
    kode = null,
    value = null
) {
    $.ajax({
        url: url,
        method: method,
        data: { kode: kode },
        success: function (data) {
            $("#" + id).empty();
            $("#" + id).append('<option value="">- Pilih -</option>');

            $.each(data.result.list, function (key, value) {
                $("#" + id).append(
                    '<option value="' +
                        value.kode.trim() +
                        '" data-provincy="' +
                        value.kode_provincy +
                        '">' +
                        value.nama +
                        ", " +
                        value.nama_regency +
                        ", " +
                        value.nama_provincy +
                        "</option>"
                );
            });

            if (id) {
                $("#" + id).select2({
                    placeholder: "--pilih " + id + "--",
                    // minimumInputLength: 3,
                    width: "100%",
                    allowClear: true,
                });
            }

            if (value) {
                setSelected(id, value);
            }
        },
    });
}

function setDropDown(id, data, kode = null) {
    $("#" + id).empty();
    $("#" + id).attr("disabled", false);
    $("#" + id).append('<option value="">- Pilih - </option>');
    $.each(data, function (key, value) {
        $("#" + id).append(
            '<option value="' + value.id + '">' + value.value + "</option>"
        );
    });

    if (kode != null) {
        setSelected(id, kode);
    }

    $("#" + id).select2({
        // placeholder: "Pilih " + id,
        width: "100%",
    });
}

function addDays(tanggal, hari) {
    var result = new Date(tanggal);
    result.setDate(result.getDate() + hari);
    return moment(result).format("DD-MM-YYYY");
}

function ribuan(angka) {
    var rev = parseInt(angka, 10).toString().split("").reverse().join("");
    var rev2 = "";
    for (var i = 0; i < rev.length; i++) {
        rev2 += rev[i];
        if ((i + 1) % 3 === 0 && i !== rev.length - 1) {
            rev2 += ".";
        }
    }
    return rev2.split("").reverse().join("");
}

const rupiah = (money) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(money);
};

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? +rupiah : "";
}
