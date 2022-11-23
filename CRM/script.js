$('document').ready(function () {
    DisplayData();
    CompanyData();
    //Login Process Start
    $("#login").click(function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        if (email != "" && password != "") {
            $.ajax({
                method: "POST",
                url: "index.php",
                data: {
                    action: 'login',
                    email: email,
                    password: password
                },
                success: function (data) {
                    console.log(data);
                    if (data == 'succ') {
                        window.location.href = 'main.php';
                    }
                    if (data == 'err') {
                        $("#error1").html('Invalid Email/Password...');
                    }
                }
            });
        } else {
            $("#error1").html("Please Fill out All Feilds.");
        }
    });
    //
    $("#add_employee").click(function (e) {
        $("#main_content").css("display", "none");
        $("#add_employee_area").css("display", "block");
        $("#add_company_area").css("display", "none");
        $("#manage_comp").css("display", "none");

    });
    $("#add_company").click(function (e) {
        $("#main_content").css("display", "none");
        $("#add_employee_area").css("display", "none");
        $("#add_company_area").css("display", "block");
        $("#manage_comp").css("display", "none");

    });
    $("#manage_employee").click(function (e) {
        $("#main_content").css("display", "none");
        $("#add_employee_area").css("display", "none");
        $("#add_company_area").css("display", "none");
        $("#manage_emp").css("display", "block");
        $("#manage_comp").css("display", "none");

    });
    $("#dashboard").click(function (e) {
        e.preventDefault();
        $("#main_content").css("display", "block");
        $("#add_employee_area").css("display", "none");
        $("#add_company_area").css("display", "none");
        $("#manage_emp").css("display", "none");
        $("#manage_comp").css("display", "none");

    });
    $("#manage_company").click(function (e) {
        e.preventDefault();
        $("#main_content").css("display", "none");
        $("#add_employee_area").css("display", "none");
        $("#add_company_area").css("display", "none");
        $("#manage_emp").css("display", "none");
        $("#manage_comp").css("display", "block");

    });
    //Add New Employee
    $("#employeeform").on('submit', function (e) {
        e.preventDefault();
        var id = $("#emp_id").val();
        var emp_name = $("#emp_name").val();
        var job_des = $("#job_des").val();
        var comp_id = $('#comp_name option:selected').val();
        console.log(comp_id);
        var comp_card = $("#comp_card").val();

        if (emp_name && job_des && comp_card && comp_id) {
            if (id) {
                console.log('btn clciked with id');
                $.ajax({
                    method: "POST",
                    url: "file.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        // console.log(data);
                        if (data == 'updated') {
                            $("#main_content").css("display", "none");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_comp").css("display", "none");
                            $("#manage_emp").css("display", "block");
                            $("#employeeform")[0].reset();
                            DisplayData();
                        }
                        if (data == 'failed') {
                            $("#main_content").css("display", "none");
                            $("#error3").html("Fill Out All Feilds!!!");
                        }
                    },
                });
            } else {
                console.log('btn clciked without id');
                $.ajax({
                    method: "POST",
                    url: "file.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        // console.log(data);
                        if (data == 'success') {
                            $("#main_content").css("display", "none");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_comp").css("display", "none");
                            $("#manage_emp").css("display", "block");
                            $("#employeeform")[0].reset();
                            DisplayData();
                        }
                        if (data == 'error') {
                            $("#error3").html('Company registeration Failed...');
                        }
                    },
                });
            }
        } else {
            $("#error3").html("Please Fill Out All Feilds");
        }

    });

    //Fetch Employee from Database 
    function DisplayData() {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'emp'
            },
            success: function (response) {
                $('#tbody').html(response);
                $("#employeeform")[0].reset();
            }
        });
    }
    //Fetch Company from Database 
    function CompanyData() {
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'comp'
            },
            success: function (response) {
                $('#tbody1').html(response);
                $("#companyform")[0].reset();
            }
        });
    }
    //Registeration Process Start
    $("#add_new_company").click(function (e) {
        e.preventDefault();
        var id = $('#comp_id').val();
        var comp_name = $('#comp_name1').val();
        var comp_site = $('#comp_site').val();
        if (comp_name != "" && comp_site != "") {
            if (id) {
                $.ajax({
                    method: "POST",
                    url: "index.php",
                    data: {
                        action: 'register',
                        id: id,
                        comp_name: comp_name,
                        comp_site: comp_site

                    },
                    success: function (data) {
                        console.log(data)
                        if (data == 'succ') {
                            $("#main_content").css("display", "none");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_emp").css("display", "none");
                            $("#manage_comp").css("display", "block");
                            $("#companyform")[0].reset();
                            CompanyData();
                        }
                        if (data == 'err') {
                            $("#main_content").css("display", "block");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_emp").css("display", "none");
                            $("#manage_comp").css("display", "none");
                        }

                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: "index.php",
                    data: {
                        action: 'register',
                        comp_name: comp_name,
                        comp_site: comp_site

                    },
                    success: function (data) {
                        console.log(data)
                        if (data == 'succ') {
                            $("#main_content").css("display", "none");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_emp").css("display", "none");
                            $("#manage_comp").css("display", "block");
                            $("#companyform")[0].reset();
                            CompanyData();
                        }
                        if (data == 'err') {
                            $("#main_content").css("display", "block");
                            $("#add_employee_area").css("display", "none");
                            $("#add_company_area").css("display", "none");
                            $("#manage_emp").css("display", "none");
                            $("#manage_comp").css("display", "none");
                        }

                    }
                });
            }
        } else {
            $("#error").html("Please Fill out All Feilds.");
        }
    });

    //Delete Employee record 
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'emp_del',
                id: id
            },
            success: function (data) {
                if (data == 'emp_deleted') {
                    $("#main_content").css("display", "none");
                    $("#add_employee_area").css("display", "none");
                    $("#add_company_area").css("display", "none");
                    $("#manage_emp").css("display", "block");
                    $("#manage_comp").css("display", "none");
                    DisplayData();
                }
                if (data == 'emp_err') {
                    $("#error3").html("Failed To Delete Employee Record ");
                }

            }
        });
    });
    //Delete Company record 
    $(document).on('click', '.delete1', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'comp_del',
                id: id
            },
            success: function (data) {
                if (data == 'comp_deleted') {
                    $("#main_content").css("display", "none");
                    $("#add_employee_area").css("display", "none");
                    $("#add_company_area").css("display", "none");
                    $("#manage_emp").css("display", "none");
                    $("#manage_comp").css("display", "block");
                    CompanyData();
                } else {
                    $("#error3").html("Failed To Delete Employee Record ");
                }

            }
        });
    });

    //Edit Employee Record
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');
        // console.log(id);
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'emp_edit',
                id: id
            },
            success: function (response) {
                var data = JSON.parse(response);
                $('#emp_id').val(data.id);
                console.log(data.id);
                $('#emp_name').val(data.emp_name);
                $('#job_des').val(data.job_des);
                $('#fetch_comp_name').html(data.comp_id);
                $("#preview").html('<img src="uploads/' + data.comp_card + '" width="50px" height="50px">');
                $("#main_content").css("display", "none");
                $("#add_employee_area").css("display", "block");
                $("#add_company_area").css("display", "none");
                $("#manage_emp").css("display", "none");
                $("#manage_comp").css("display", "none");
            }
        })
    });
    //Edit Company Record
    $(document).on('click', '.edit1', function () {
        var id = $(this).attr('id');
        // console.log(id);
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                action: 'comp_edit',
                id: id
            },
            success: function (response) {
                var data = JSON.parse(response);
                $('#comp_id').val(data.id);
                $('#comp_name1').val(data.comp_name);
                $('#comp_site').val(data.comp_site);
                $("#main_content").css("display", "none");
                $("#add_employee_area").css("display", "none");
                $("#add_company_area").css("display", "block");
                $("#manage_emp").css("display", "none");
                $("#manage_comp").css("display", "none");
            }
        })
    });
    //LogOut
    $("#logout").click(function () {
        $.ajax({
            url: "logout.php",
            method: 'POST',
            data: {
                action: 'logout'
            },
            success: function (data) {
                if (data == 'logout') {
                    window.location.href = 'login.php';
                }
            }
        });
    });//logout end 

    $(document).ready(function () {
        $('#myTable').DataTable();
    });
    $(document).ready(function () {
        $('#myTable2').DataTable();
    });
});