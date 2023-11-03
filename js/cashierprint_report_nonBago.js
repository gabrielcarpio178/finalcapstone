let semester_label = 'First-semester/Second-semester';
let year_label = '';
let semester_label_val = '';
let year = '';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    yearSemester();
    $(".txt, #sortByYear, .checkbox").each(function() {
        $(this).change(function(){
            year = $(this).val();
            year_label = $(this).find(":selected").text();
            getSemBy(year);
            getSemByYear(year_label, 'First-semester/Second-semester');
            getDateRange(year, 'all');
        }); 
    });

    $(".txt, #sortBySemister, .checkbox").each(function() {
        $(this).change(function(){
            semester_label = $(this).find(":selected").text();
            semester_label_val = $(this).val();
            if(semester_label=='All') semester_label = 'First-semester/Second-semester';
            getSemByYear(year_label, semester_label);
            getDateRange(year, semester_label_val);
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
                var date_current = new Date((year_res[0]).start_year);
                if(i==0){
                    school_year+=`<option value='current_year'>${date_data.getFullYear()}-${parseInt(date_data.getFullYear())+1}</option>`;
                }else{
                    school_year+=`<option value='${(year_res[i]).semester_pair}'>${date_data.getFullYear()}-${parseInt(date_data.getFullYear())+1}</option>`;
                }
                
            }  
            year = (year_res[0]).semester_pair;
            $("#sortByYear").html(school_year);
            getSemBy((year_res[0]).semester_pair);
            getDateRange((year_res[0]).semester_pair, 'all');
            getSemByYear(`${date_current.getFullYear()}-${parseInt(date_current.getFullYear())+1}`, 'First-semester/Second-semester');
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
            semester= '<option value="all">All</option>';
            for(let i = 0; i < semesters.length; i++){
                semester +=`<option value='${(semesters[i]).semester}'>${((semesters[i]).semester)[0].toUpperCase()+((semesters[i]).semester).slice(1)}</option>`;
            }
            $("#sortBySemister").html(semester);
        }
    })
}
function getSemByYear(year, sem){
    $(".school-year").html(`A.Y. ${year}, ${sem}`);
}

function getDateRange(year_pair, sem_category){
    $.ajax({
        url: '../../controller/DbcashierGetDateRange.php',
        type: 'POST',
        data: {year_pair : year_pair, sem_category : sem_category},
        cache: false,
        success: function(res){
            var year_res = JSON.parse(res);
            $("#start_date").val(year_res.start);
            $("#end_date").val(year_res.end);
            $("#start_date").attr({"max" : year_res.end,"min" : year_res.start});
            $("#end_date").attr({"max" : year_res.end,"min" : year_res.start});
        }
    });

}