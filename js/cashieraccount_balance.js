let search = '';
let current = 'current_year';
let semester = 'current';
let sortBy = 'all';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    yearSemester();
    displaydata('', current, semester, 'all', 0);

    $("#search_user").on("keyup", function(){
        search = $(this).val();
        displaydata(search, current, semester, sortBy, 0);
    });

    $(".txt, #sortBy, .checkbox").each(function() {
        $(this).change(function(){
            sortBy = $(this).val();
            displaydata(search, current, semester, sortBy, 0);
        }); 
    });

    $(".txt, #sortByYear, .checkbox").each(function() {
        $(this).change(function(){
            current = $(this).val();
            getSemBy(current);

        }); 
    });

    $(".txt, #sortBySemister, .checkbox").each(function() {
        $(this).change(function(){
            semester = $(this).val();
            displaydata(search, current, semester, sortBy, 0);
        }); 
    });

});

function yearSemester(){
    $.ajax({
        url: '../../controller/DbcashierGetYearData.php',
        type: 'POST',
        data: {cashier: 'cashier'},
        cache: false,
        success: function(res){
            var year_res = JSON.parse(res);
            school_year = '';
            last_pair = 0;
            for(let i = 0; i<year_res.length; i++){
                var date_data = new Date((year_res[i]).start_year);
                school_year+=`<option value='${(year_res[i]).semester_pair}'>${date_data.getFullYear()}-${parseInt(date_data.getFullYear())+1}</option>`;
            }  
            $("#sortByYear").html(school_year);
            getSemBy((year_res[0]).semester_pair);
        }
    })
}

function getSemBy(semester_pair){       
    $.ajax({
        url: '../../controller/DbGetSemester_pair.php',
        type: 'POST',
        data: {semester_pair : semester_pair},
        cache: false,
        success: function(res){
            var semesters = JSON.parse(res);
            semester= '<option value="current">Current</option>';
            for(let i = 0; i < semesters.length; i++){
                semester +=`<option value='${(semesters[i]).semester}'>${((semesters[i]).semester)[0].toUpperCase()+((semesters[i]).semester).slice(1)}</option>`;
            }
            $("#sortBySemister").html(semester);
        }
    })
}

function displaydata(search, semesterYear_data, semester_category, sortBy, page_num){
    $.ajax({
        url:'../../controller/DbcashierAccountBalanceTable.php',
        type: 'POST',
        data:{
            search:search,
            semesterYear_data : semesterYear_data,
            semester_category : semester_category,
            sortBy:sortBy,
            page_num:page_num
        },
        cache: false,
        success:function(res){
            $(".table-content").html(res);
        }
    })
}

function page(num){
    displaydata(search, sortBy, num);
}