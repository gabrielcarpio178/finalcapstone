$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    yearSemester();

    $(".txt, #sortByYear, .checkbox").each(function() {
        $(this).change(function(){
            year = $(this).val();
            getSemBy(year);
            displaydata(search, year, 'all', sortBy, 0);
            semester_label("all");
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
                if(i==0){
                    school_year+=`<option value='current_year'>${date_data.getFullYear()}-${parseInt(date_data.getFullYear())+1}</option>`;
                }else{
                    school_year+=`<option value='${(year_res[i]).semester_pair}'>${date_data.getFullYear()}-${parseInt(date_data.getFullYear())+1}</option>`;
                }
                
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
            semester= '<option value="all">All</option>';
            for(let i = 0; i < semesters.length; i++){
                semester +=`<option value='${(semesters[i]).semester}'>${((semesters[i]).semester)[0].toUpperCase()+((semesters[i]).semester).slice(1)}</option>`;
            }
            $("#sortBySemister").html(semester);
        }
    })
}