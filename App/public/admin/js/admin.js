$(document).ready(function () {
    //lay cau hoi
    function getQuestion(id) {
        $.ajax({
            type: "GET",
            url: "php/danhsachcauhoi.php",
            data: { ID: id },
            dataType: "text",
            success: function (response) {
                var data = JSON.parse(response);
                //phan trang
                var s = "<ul class='pagination'>";
                for (var i = 1; i <= Math.ceil(data.length / 10); i++) {
                    s += "<li><a href='#'>" + i + "</a></li>";
                }
                s += "</ul>";
                $("#phantrang").html(s);

                function hiencauhoi(trang) {
                    var s = "";
                    for (var i = 0; i < 10; i++) {
                        var stt = (trang - 1) * 10 + i;
                        if (stt == data.length) {
                            break;
                        }
                        //<input type="button" value="Thêm câu hỏi" class="btn btn-primary btnThemMon" id="ThemCauHoi"
                        //data-toggle="modal" data-target="#modalThemCauHoi">
                        s += "<input type='button' value='Xóa' class='btn btn-danger'> ";
                        s += " <input type='button' value='Sửa' class='btn btn-info' data-toggle='modal' data-target='#modalSuaCauHoi'>";
                        s += "<xmp>";
                        s += "Câu " + (stt + 1) + ". ";
                        s += data[stt].NoiDung + "</xmp>";
                        s += "<ol type='A'>"
                        $(data[stt].DapAn).each(function (index, dapan) {
                            s += "<li>";
                            if (dapan.DapAn == true) {
                                s += "<xmp style='color:red'>";
                            }
                            else {
                                s += "<xmp>";
                            }
                            s += dapan.NoiDung;
                            s += "</xmp>";
                            s += "</li>";
                        });
                        s += "</ol>";
                    }
                    $("#cauhoi").html(s);
                }
                hiencauhoi(1);
                $("#phantrang a").click(function () {
                    var trang = $(this).html();
                    hiencauhoi(trang);

                });

                //click xoa cau hoi
                $("input[value='Xóa']").each(function (index, element) {
                    $(this).click(function () {
                        if (confirm("Bạn có chắc muốn xóa câu hỏi không?")) {
                            $.ajax({
                                type: "POST",
                                url: "php/xoacauhoi.php",
                                data: { ID: data[index].ID },
                                dataType: "text",
                                success: function (response) {
                                    alert(response);
                                    getQuestion(idClick);
                                }
                            });
                        }
                    });
                });

                //chon cau hoi de sua
                var ch = { DapAn: [] };
                $("input[value='Sửa']").each(function (index, element) {
                    $(this).click(function () {
                        var cauhoi = data[index];
                        ch = { DapAn: [] };
                        ch.ID = cauhoi.ID;
                        console.log(cauhoi);
                        $("#sua_noiDungCauHoi").html(cauhoi.NoiDung);
                        $("#sua_doKho").val(cauhoi.DoKho);
                        var s = "<ol type='A'>";
                        $(cauhoi.DapAn).each(function (i, e) {
                            ch.DapAn.push({ ID: e.ID });
                            s += "<li><input type='radio' name='suadapan' ";
                            if (e.DapAn == true) {
                                s += "checked='checked'";
                            }
                            s += "><textarea>";
                            s += e.NoiDung;
                            s += "</textarea></li>";
                        });
                        s += "</ol>";
                        $("#sua_dapAn").html(s);
                    });

                });

                //click sua cau hoi
                $("#btnSuaCauHoi").unbind('click');
                $("#btnSuaCauHoi").click(function () {
                    ch.NoiDung = $("#sua_noiDungCauHoi").val();
                    ch.DoKho = $("#sua_doKho").val();
                    $("#sua_dapAn textarea").each(function (i, e) {
                        ch.DapAn[i].NoiDung = $(this).val();

                    });
                    $("#sua_dapAn input[type='radio']").each(function (i, e) {
                        ch.DapAn[i].DapAn = $(this).prop("checked");

                    });
                    $.ajax({
                        type: "POST",
                        url: "php/suacauhoi.php",
                        data: { CH: JSON.stringify(ch) },
                        dataType: "text",
                        success: function (response) {
                            alert(response);
                            $("#closeSuaCauHoi").trigger('click');
                            getQuestion(idClick);
                        },
                        error: function () {
                            alert("Có lỗi xảy ra");
                        }
                    });
                });

            },
            error: function () {
                alert("Có lỗi xảy ra");
            }
        });
    }

    //lay danh sach mon hoc 
    var idClick = 0;
    function getListSubject() {
        $.ajax({
            type: "GET",
            url: "php/danhsachmonhoc.php",
            data: "",
            dataType: "text",
            success: function (response) {
                var data = JSON.parse(response);
                var s = "";
                var s2 = "";
                data.forEach(function (e) {
                    s += "<div>";
                    s += e.TenMonHoc;
                    s += "</div>"
                    s2 += "<option value='" + e.ID + "'>";
                    s2 += e.TenMonHoc;
                    s2 += "</option>";
                });
                $("#monhoc").html(s);
                $("#danhsachmon").html(s2);
                $("#sua_danhsachmon").html(s2);
                $("#xoa_danhsachmon").html(s2);
                $("#sua_SubjectName").val($("#sua_danhsachmon option:selected").text());
                //click mon hoc
                $("#monhoc div").each(function (index, element) {
                    $(this).unbind('click');
                    $(this).click(function () {
                        $(".col9").show();  
                        var s = $(this).html();
                        $("#name").html(s);
                        idClick = data[index].ID;
                        $("#danhsachmon").val(idClick);
                        $("#sua_danhsachmon").val(idClick);
                        $("#xoa_danhsachmon").val(idClick);
                        $("#sua_SubjectName").val($("#sua_danhsachmon option:selected").text());
                        getQuestion(idClick);

                    });

                });

            }
        });
    }
    getListSubject();
    // $("#ThemMonHoc").click(function () {
    //     $("#addSubject").show();
    // });

    //click them mon hoc
    $("#btnThem").click(function () {
        var subjectName = $("#subjectName").val().trim();
        if (subjectName == "" || subjectName == null) {
            alert("chưa nhập tên môn học");
        }
        else {
            $.ajax({
                type: "POST",
                url: "php/themmonhoc.php",
                data: { name: subjectName },
                dataType: "text",
                success: function (response) {
                    alert(response);
                    $("#subjectName").val("");
                    getListSubject();
                    $("#closeThemMH").trigger('click');
                },
                error: function () {
                    alert("có lỗi xảy ra");
                }
            });
        }
    });

    //click sua mon hoc
    $("#btnSuaMH").click(function () {
        if ($("#sua_SubjectName").val().trim() == "" || $("#sua_SubjectName").val() == null) {
            alert("Tên môn học không được để trống");
        }
        else {
            var mh = {};
            mh.ID = $("#sua_danhsachmon").val();
            mh.tenMonHoc = $("#sua_SubjectName").val();
            $.ajax({
                type: "POST",
                url: "php/suamonhoc.php",
                data: mh,
                dataType: "text",
                success: function (response) {
                    alert(response);
                    getListSubject();
                    $("#closeSuaMH").trigger('click');
                },
                error: function () {
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
        }
    });

    //click xoa mon hoc
    $("#btnXoaMH").click(function () {
        if (confirm("Bạn có chắc muốn xóa môn học này không?")) {
            var ID = $("#xoa_danhsachmon").val();
            $.ajax({
                type: "POST",
                url: "php/xoamonhoc.php",
                data: { id: ID },
                dataType: "text",
                success: function (response) {
                    alert(response);
                    getListSubject();
                    $("#closeXoaMH").trigger('click');
                },
                error: function () {
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
        }

    });

    $("#sua_danhsachmon").change(function (e) {
        $("#sua_SubjectName").val($("#sua_danhsachmon option:selected").text());

    });


    //click them cau hoi
    // $("#btnThemCauHoi").unbind('click');
    $("#btnThemCauHoi").click(function () {
        var cauhoi = {};
        cauhoi.noiDung = $("#noiDungCauHoi").val();
        cauhoi.IDMH = $("#danhsachmon").val();
        cauhoi.doKho = $("#doKho").val();
        cauhoi.dapAn = [];
        $("#dapAn textarea").each(function (index, element) {
            var da = {};
            da.noiDung = $(this).val();
            da.dapAn = $("#dapAn" + index).is(':checked');
            cauhoi.dapAn.push(da);
        });
        if (cauhoi.noiDung.trim() == '' || cauhoi.noiDung == null) {
            alert("Chưa nhập nội dung");
        }
        else {
            var kt = false, kt2 = true;
            for (var i = 0; i < cauhoi.dapAn.length; i++) {
                if (cauhoi.dapAn[i].noiDung.trim() == '' || cauhoi.dapAn[i].noiDung == null) {
                    kt2 = false;
                    break;
                }
                if (cauhoi.dapAn[i].dapAn == true) {
                    kt = true;
                }
            }
            if (!kt2) {
                alert("Chưa nhập nội dung câu hỏi");
            }
            else if (!kt) {
                alert("Chưa chọn đáp án đúng");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "php/themcauhoi.php",
                    data: { data: JSON.stringify(cauhoi) },
                    dataType: "text",
                    success: function (response) {
                        alert(response);
                        $("#closeThemCauHoi").trigger('click');
                        $("#noiDungCauHoi").val("");
                        loadDapAn(4);
                        getQuestion(idClick);
                    },
                    error: function () {
                        alert("Có lỗi xảy ra");
                    }
                });
            }
        }
    });

    function loadDapAn(x) {
        var s = "<ol type='A'>";
        for (var i = 0; i < x; i++) {
            s += "<li>";
            s += "<input type='radio' name='dapan' id='dapAn" + i + "'>";
            s += "<textarea type='text'></textarea>";
            s += "</li>";
        }
        s += "</ol>";
        $("#dapAn").html(s);

    }
    loadDapAn(4);

    $("#soLuongDapAn").change(function () {
        var x = $(this).val();
        loadDapAn(x);
    });

    $("#gioBatDau").val((new Date((new Date).getTime() + 25200000)).toISOString().slice(0,16));
    $("#gioKetThuc").val((new Date((new Date).getTime() + 28800000)).toISOString().slice(0,16));
    //click them lich thi
    $("#btnThemLichThhi").click(function () { 
        var start= Date.parse($("#gioBatDau").val());
        var end= Date.parse($("#gioKetThuc").val());
        var x = $("#gioBatDau").val();
        var y = $("#gioKetThuc").val();
        if(start>end || end<Date.parse(new Date) || x=="" || y==""){
            alert("Thời gian không hợp lệ");
        }
        else{
            $.ajax({
                type: "POST",
                url: "php/caithoigianthi.php",
                data: {batDau:$("#gioBatDau").val(),
                        ketThuc:$("#gioKetThuc").val(),
                        IDMH: idClick
                    },
                dataType: "text",
                success: function (response) {
                    alert(response);
                    if(response!="Trùng lịch thi"){
                        $("#closeLichThi").trigger('click');
                    }
                },
                error:function(){
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
        }
    });

    $("#btnQLDT").click(function () { 
       $.ajax({
           type: "POST",
           url: "php/laysoluongcauhoitrongdethi.php",
           data: {IDMH: idClick},
           dataType: "text",
           success: function (response) {
               $("#soLuongCauHoi").val(response);
           }
       });
        
    });
    //click quan ly de thi
    $("#btnOK").click(function () { 
        var soLuongCauHoi = $("#soLuongCauHoi").val();
        $.ajax({
            type: "POST",
            url: "php/quanlydethi.php",
            data: {
                IDMH: idClick,
                SL: soLuongCauHoi
            },
            dataType: "text",
            success: function (response) {
                alert(response);
                $("#closeQLDT").trigger('click');
            },
            error: function() {
                alert("Có lỗi xảy ra, vui lòng thử lại");
            }
        });

    });
    
    $(".btnDangXuat").click(function () { 
        window.location.href = "{{ route('logout.view') }}";
    });
    
    $("#btnThemTK").click(function () { 
        var tenDangNhap = $("#tenDangNhap").val();
        var matKhau = $("#matKhau").val();
        $.ajax({
            type: "GET",
            url: "{{ route('taotaikhoan.create') }}",
            data: {
                tenTK: tenDangNhap,
                mK : matKhau
            },
            dataType: "text",
            success: function (response) {
                alert(response);
                $("#closeThemTK").trigger('click');
            }
        });
    });


    //lay danh sach lich thi
    $("#btnLichThi").click(function () { 
        $.ajax({
            type: "POST",
            url: "php/laythoigianthi.php",
            data: {IDMH : idClick},
            dataType: "text",
            success: function (response) {
                var data = JSON.parse(response);
                var s="<table class= 'table table-bordered'>";
                s+= "<tr>";
                s+= "<th>";
                s+="Thời gian bắt đầu";
                s+="</th>";
                s+= "<th>";
                s+="Thời gian kết thúc";
                s+="</th>";
                s+= "<th>";
                s+="Thao tác";
                s+="</th>";
                $(data).each(function (index, e) {
                    s+="<tr>"
                    s+="<td>";
                    s+= e.start;
                    s+="</td>";
                    s+="<td>";
                    s+= e.end;
                    s+="</td>";
                    s+="<td>";
                    s+= "<a id='" + e.ID + "'><span class='glyphicon glyphicon-trash'></span> Xóa </a>"
                    s+="</td>";
                    s+="</tr>";
                });
                s+="</tr>"
                s+="</table>";
                $("#lichthi").html(s);
                //click xoa lich thi
                $("#lichthi a").click(function () { 
                    var id = $(this).attr('id');
                    if(confirm("Bạn có muốn xóa lịch thi này không?")){
                        $.ajax({
                            type: "POST",
                            url: "php/xoalichthi.php",
                            data: {ID:id},
                            dataType: "text",
                            success: function (response) {
                                alert(response);
                                $("#closeLichThi").trigger('click');
                            }
                        });
                    }
                });
            },
            error: function(){
                alert("Có lỗi xảy ra, vui lòng thử lại");
            }
        });
    });
});