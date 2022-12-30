$(document).ready(function () {
    let str = ''
    str = `<option value="">請選擇</option>`;
    $.getJSON('../controller/json/Division.json', function (data) {
        $.each(data, function (i, item) {
            str+= `<option id="${item.divisionID}">${item.divisionName}</option>`
        });
		$("#schoolDistrict").html(str);
    });
});

//(分區)
$("#schoolDistrict").change(function () {
    var id = $(this).find("option:checked").attr("id");
    let str = ''
    str = `<option value="">請選擇</option>`;
    $.getJSON('../controller/json/School/' + id + '.json', function (data) {
        $.each(data, function (i, item) {
            str += `<option id="${item.schoolID}">${item.schoolName}</option>`
        });
    $("#schoolPre").html(str);
    });
});

//(學校)
$("#schoolPre").change(function () {
    var id = $(this).find("option:checked").attr("id");
    let str = ''
    str = `<option value="">請選擇</option>`;
    $.getJSON('../controller/json/College/' + id + '.json', function (data) {
        $.each(data, function (i, item) {
            str += `<option id="${item.collegeID}">${item.collegeName}</option>`
        });
    $("#captainCollege").html(str);
    $("#member1College").html(str);
    $("#member2College").html(str);
	});
});

//(學院)
$("#captainCollege").change(function () {
    getDepart("captain");
});
$("#member1College").change(function () {
    getDepart("member1");
});
$("#member2College").change(function () {
    getDepart("member2");
});

function getDepart(type){
    var id = $("#"+type+"College").find("option:checked").attr("id");
    let str = ''
    str = `<option value="">請選擇</option>`;
    $.getJSON('../controller/json/Depart/' + id + '.json', function (data) {
        $.each(data, function (i, item) {
            str += `<option>${item.departName}</option>`
        });
    $("#"+type+"Depart").html(str);
	});
}