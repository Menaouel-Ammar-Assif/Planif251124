function colorTime (val)    
    {
        if(val< 99.99) {actColorTime = 'bg-warning';}
        else           {actColorTime = 'bg-danger'; }

        return actColorTime;
    }
    function colorStat (val)
    {
        // if(val< 50) {actColorEtat = 'bg-warning';}
        // else        {actColorEtat = 'bg-success';}
        actColorEtat = 'bg-success';

        return actColorEtat;
    }

    function colorTimeText (val)
    {
        if(val< 99.99) {actColorTimeText = 'text-warning';}
        else           {actColorTimeText = 'text-danger'; }

        return actColorTimeText;
    }

    function colorStatText (val)
    {
        // if(val< 50) {actColorEtat = 'bg-warning';}
        // else        {actColorEtat = 'bg-success';}
        actColorEtat = 'text-success';

        return actColorEtat;
    }


    $(document).ready(function() {
        $('#actCopDr').DataTable();
    });



    ///////////// COP ///////////////////////////////////////////////////////////////////////////////////////////////////////


    $(document).ready(function () 
    {
    ////////////////////START Objectif Selector ///////////////////////////////////////////////////////////////////
        $('#Objectif').on('change', function () 
        {
                let id_obj = $(this).val();

                $('#SousObjectif').empty();
                $('#SousObjectif').append(`<option value="0" disabled selected>Traitement...</option>`);

            $.ajax({
                type: 'GET',
                url: '{{ url("/sObj") }}/' + id_obj,
                success: function (response)
                {
                    var response = JSON.parse(response);

                    $('#SousObjectif').empty();
                    $('#SousObjectif').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Sous Objectif *</option>`);

                    response.forEach(element => { $('#SousObjectif').append(`<option value="${element['id_sous_obj']}">${element['lib_sous_obj']}</option>`); });
                }
            });
        });
    //////////////////// END Objectif Selector ////////////////////////////////////////////////////////////////////

    ////////////////////START Sous Objectif Selector //////////////////////////////////////////////////////////////
    $('#SousObjectif').on('change', function () 
    {
            let id_sous_obj = $(this).val();

            $('#Indicateur').empty();
            $('#Indicateur').append(`<option value="0" disabled selected>Traitement...</option>`);

        $.ajax({

            type: 'GET',
            url: '{{ url("/ind") }}/' + id_sous_obj,
            success: function (response) 
            {
                var response = JSON.parse(response);

                $('#Indicateur').empty();
                $('#Indicateur').append(`<option value="0" style="font-weight: bolder; color: rgb(169, 168, 168);" disabled selected>Selectionnez un Indicateur*</option>`);

                response.forEach(element => { $('#Indicateur').append(`<option value="${element['id_ind']}">${element['lib_ind']}</option>`); });
            }
        });
    });
    ////////////////////END Sous Objectif Selector ////////////////////////////////////////////////////////////////

    ////////////////////START Indicateur Selector /////////////////////////////////////////////////////////////////
        $('#Indicateur').on('change', function () 
        {
                let id_ind = $(this).val();
                var dataTable = $('#actCop').DataTable();
                var dataTableDr = $('#actCopDr').DataTable();
                var dataTableCsDc = $('#causeDc').DataTable();
                var dataTableCsDr = $('#causeDr').DataTable();

                let month = $('#month').val();
                let progressBarHTML;
                let progressBarHTMLDr;


            $.ajax({

                type: 'GET',
                url: '{{ url("/res") }}/' + id_ind,
                data: { month: month },

                success: function (response) 
                {
                    console.log(response.ecartType)

                    dataTable.clear().draw(); 
                    dataTableDr.clear().draw();
                    dataTableCsDc.clear().draw();
                    dataTableCsDr.clear().draw();
                    
                    ///////////// START test type /////////////////////////////////////

                    const unitMapping = {
                            'DA': 'DA',
                            'NB': ' ',
                            'J': 'Jours',
                            'HJ': 'Heures / Jours',
                            'H': 'Heures',
                        };

                        const pMapping = {
                            '03': 'Trimestriel',
                            '06': 'Semestriel',
                            '09': '3eme Trimestre',
                            '12': 'Annuel',    
                        };
                        const pMapping2 = {
                            '03': 'Trimestrielle',
                            '06': 'Semestrielle',
                            '09': '3eme Trimestre',
                            '12': 'Annuelle',    
                        };

                    if (response.type == 'nd') 
                    {

                        $('#numDenom').removeClass('d-none').addClass('d-block');
                        $('#chiffre').removeClass('d-block').addClass('d-none');

                        $('#typeN').text(unitMapping[response.uniteNum] || '/');
                        $('#typeD').text(unitMapping[response.uniteDenom] || '/');

                        $('#num').text((response.libNum || '/') + ' :');
                        $('#denom').text((response.libDenom || '/') + ' :');
                        $('#numVal').val(response.valNum || '/');
                        $('#denomVal').val(response.valDenom || '/');
                        $('#formuleNumDenom').text('La formule de calcul : ' + (response.formule || '/'));

                        if (id_ind != '8') {
                            $('#Result').val(response.R + ' %');
                        }else{
                            $('#Result').val(response.R + ' DA');
                        }


                        $('#cibleName').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                        $('#simuND').text('La simulation ' + pMapping2[month] + ' :' || '/');
                        $('#Cible1').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#Cible2').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                        $('#ecartName').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                        $('#ecartND').val(response.ecart + ' %' || '/');
                        $('#ecartND2').val(response.ecart2 + ' %' || '/');

                        if (response.ecartType =='positif') {
                            $('#performantND').text("Performant");
                            $('#ecartND').removeClass('bg-danger').addClass('bg-success');
                            $('#performantND-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_ND_Icon_').removeClass('d-none').addClass('d-block');
                            $('#performant_ND_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }if (response.ecartType =='négatif'){
                            $('#performantND').text("Non performant");
                            $('#ecartND').removeClass('bg-success').addClass('bg-danger');
                            $('#performantND-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_ND_Icon_').removeClass('d-block').addClass('d-none');
                        } 


                        if (response.ecartType2 =='positif') {
                            $('#performantND2').text("Performant");
                            $('#ecartND2').removeClass('bg-danger').addClass('bg-success');
                            $('#performantND2-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_ND_Icon2_').removeClass('d-none').addClass('d-block');
                            $('#performant_ND_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }if (response.ecartType2 =='négatif'){
                            $('#performantND2').text("Non performant");
                            $('#ecartND2').removeClass('bg-success').addClass('bg-danger');
                            $('#performantND2-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_ND_Icon2_').removeClass('d-block').addClass('d-none');
                        } 
                        
                    }
                    else 
                    {

                        // const unitMapping = 
                        // {
                        //     'DA': 'DA',
                        //     'NB': ' ',
                        //     'J': 'Jours',
                        //     'HJ': 'Heures / Jours',
                        //     'H': 'Heures',
                        // };

                        // const pMapping = {
                        //     '03': 'Trimestriel',
                        //     '06': 'Semestriel',
                        //     '09': '3eme Trimestre',
                        //     '12': 'Annuel',    
                        // };

                        $('#numDenom').removeClass('d-block').addClass('d-none');
                        $('#chiffre').removeClass('d-none').addClass('d-block');
                        $('#typeC').text(unitMapping[response.uniteC] || '/');

                        $('#chifr').text(response.libChiffre || '/');
                        $('#ResultChiffre').val(response.valChiffre || '/');
                        $('#formuleChiffre').text('La formule de calcul: ' + (response.formule || '/'));
                        $('#cibleNameCH').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                        $('#simuCH').text(('La simulation ' + pMapping2[month] + ' :' || '/'));
                        $('#Cible2CH').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#Cible2CH_P').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                        $('#ecartNameCH').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                        $('#ecartC').val(response.ecart + ' %' || '/');
                        $('#ecartC2').val(response.ecart2 + ' %' || '/');


                        if (response.ecartType =='positif') {
                            $('#performantC').text("Performant");
                            $('#ecartC').removeClass('bg-danger').addClass('bg-success');
                            $('#performantC-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_CH_Icon_').removeClass('d-none ').addClass('d-block');
                            $('#performant_CH_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }
                        if(response.ecartType =='négatif'){
                            $('#performantC').text("Non performant");
                            $('#ecartC').removeClass('bg-success').addClass('bg-danger');
                            $('#performantC-BG').removeClass('bg-success').addClass('bg-danger');
                        }

                        if (response.ecartType2 =='positif') {
                            $('#performantC2').text("Performant");
                            $('#ecartC2').removeClass('bg-danger').addClass('bg-success');
                            $('#performantC2-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_CH_Icon2_').removeClass('d-none').addClass('d-block');
                            $('#performant_CH_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');

                            
                        }
                        if(response.ecartType2 =='négatif') {
                            $('#performantC2').text("Non performant");
                            $('#ecartC2').removeClass('bg-success').addClass('bg-danger');
                            $('#performantC2-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_CH_Icon2_').removeClass('d-block').addClass('d-none');
                        }

                    }
                    ////////////// END test type ///////////////////////////////////

                    ////////////// START Ecart test /////////////////////////////////
                    if (response.ecartType === 'négatif---') 
                    {

                        document.getElementById('CDC').style.display = 'block';
                        document.getElementById('CDR').style.display = 'block';

                        if (response.causesDc.length > 0) 
                        {
                            for (let i = 0 ; i<response.causesDc.length ; i++)

                            {
                                var newRow = dataTableCsDc.row.add([
                                    response.causesDc[i].lib_dir,    
                                    response.causesDc[i].lib_cause,
                                    response.causesDc[i].lib_correct,
                                    ]).draw(false).node();
                                    newRow.id = 'cause'+i;
                            }
                                
                        }

                        if (response.causesDr.length > 0) 
                        {
                            for (let i = 0 ; i<response.causesDr.length ; i++)

                            {
                                var newRow = dataTableCsDc.row.add([
                                    response.causesDr[i].lib_dir,    
                                    response.causesDr[i].lib_cause,
                                    response.causesDr[i].lib_correct,
                                    ]).draw(false).node();
                                    newRow.id = 'cause'+i;
                            }
                                
                        }
                    } 
                    else
                    {
                    document.getElementById('CDC').style.display = 'none';
                    document.getElementById('CDR').style.display = 'none';
                    }
                    ////////////// END Ecart test /////////////////////////////////



                    ///////////// START ACTION DC  //////////////////////////////////
                    response.actionsDc.forEach(function(action)
                    {
                            var startDate = new Date(action.dd);
                            var endDate = new Date(action.df);

                            let JSdate = @json($JSdate);
                            var currentDate = new Date(JSdate);

                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;

                            if (currentDate < startDate) {
                                tempEcolAct = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolAct = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolAct = 100;
                            }

                            actColorTime = colorTime (tempEcolAct);
                            actColorEtat = colorStat (action.etat);
                            
                            if(action.etat == null)
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +action.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +action.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtat+'" style="width: ' + action.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }


                            response.act_cops.forEach(function(act_cop)
                            {
                                if(action.id_act == act_cop.id_act)
                                {
                                    var startDate = new Date(action.dd);
    
                                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                    var endDate = new Date(action.df);
    
                                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    
                                    var newRow = dataTable.row.add([
                                    act_cop.lib_dc,
                                    act_cop.lib_act_cop,
                                    formattedStartDate,
                                    formattedEndDate,
                                    progressBarHTML,
                                    ]).draw(false).node();
                                    newRow.id = action.id_act;
    
                                }
                            });


                    });
                    //////////// END ACTION DC ///////////////////////////////////////

                    ///////////// START ACTION DR  //////////////////////////////////
                    response.actionsDr.forEach(function(actiondr)
                    {
                        var startDate = new Date(actiondr.dd);
                        var endDate = new Date(actiondr.df);

                        let JSdate = @json($JSdate);
                        var currentDate = new Date(JSdate);

                        var totalDuration = endDate.getTime() - startDate.getTime();
                        var tempEcolAct;

                        if (currentDate < startDate) {
                            tempEcolActDr = 0;
                        } else if (currentDate <= endDate) {
                            var currentDuration = currentDate.getTime() - startDate.getTime();
                            tempEcolActDr = ((currentDuration / totalDuration) * 100);
                        } else {
                            tempEcolActDr = 100;
                        }

                        actColorTimeDr = colorTime (tempEcolActDr);
                        actColorEtatDr = colorStat (actiondr.etat);
                    

                        if(actiondr.etat == null)
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +actiondr.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +actiondr.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtatDr+'" style="width: ' + actiondr.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }

                        
                        //  get directions name //////////////////////////////////////////////////////////////////////////
                        response.directionsDr.forEach(function(direction)
                        {
                            if(actiondr.id_dr == direction.id_dir)
                            {
                                var ddDate = new Date(actiondr.dd);
                                var formattedDD = ("0" + ddDate.getDate()).slice(-2) + "/" + ("0" + (ddDate.getMonth() + 1)).slice(-2) + "/" + ddDate.getFullYear();

                                var dfDate = new Date(actiondr.df);
                                var formattedDF = ("0" + dfDate.getDate()).slice(-2) + "/" + ("0" + (dfDate.getMonth() + 1)).slice(-2) + "/" + dfDate.getFullYear();

                                var newRow = dataTableDr.row.add([
                                direction.lib_dir,
                                actiondr.lib_act_cop_dr,
                                formattedDD,
                                formattedDF,
                                progressBarHTMLDr,
                                ]).draw(false).node();
                                newRow.id = actiondr.id_act_cop_dr;

                            }
                        });

                    });
                    ///////////// END ACTION DR  /////////////////////////////////////
                }

            });
        });


    //////////////////// Month Selector ///////////////////
        $('#month').on('change', function () 
        {
                let month = $(this).val();
                var dataTable = $('#actCop').DataTable();
                var dataTableDr = $('#actCopDr').DataTable();
                var dataTableCsDc = $('#causeDc').DataTable();
                var dataTableCsDr = $('#causeDr').DataTable();

                let id_ind = $('#Indicateur').val();
                let progressBarHTML;
                let progressBarHTMLDr;


            $.ajax({

                type: 'GET',
                url: '{{ url("/res") }}/' + id_ind,
                data: { month: month },

                success: function (response) 
                {
                    console.log(response.ecartType)

                    dataTable.clear().draw(); 
                    dataTableDr.clear().draw();
                    dataTableCsDc.clear().draw();
                    dataTableCsDr.clear().draw();

                    const unitMapping = {
                            'DA': 'DA',
                            'NB': ' ',
                            'J': 'Jours',
                            'HJ': 'Heures / Jours',
                            'H': 'Heures',
                        };

                        const pMapping = {
                            '03': 'Trimestriel',
                            '06': 'Semestriel',
                            '09': '3eme Trimestre',
                            '12': 'Annuel',    
                        };

                        const pMapping2 = {
                            '03': 'Trimestrielle',
                            '06': 'Semestrielle',
                            '09': '3eme Trimestre',
                            '12': 'Annuelle',    
                        };
                    
                    ///////////// START test type /////////////////////////////////////
                    if (response.type == 'nd') 
                    {

                        $('#numDenom').removeClass('d-none').addClass('d-block');
                        $('#chiffre').removeClass('d-block').addClass('d-none');

                        $('#typeN').text(unitMapping[response.uniteNum] || '/');
                        $('#typeD').text(unitMapping[response.uniteDenom] || '/');

                        $('#num').text((response.libNum || '/') + ' :');
                        $('#denom').text((response.libDenom || '/') + ' :');
                        $('#numVal').val(response.valNum || '/');
                        $('#denomVal').val(response.valDenom || '/');
                        $('#formuleNumDenom').text('La formule de calcul : ' + (response.formule || '/'));


                        if (id_ind != '8') {
                            $('#Result').val(response.R + ' %');
                        }else{
                            $('#Result').val(response.R + ' DA');
                        }

                    
                        $('#cibleName').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                        $('#simuND').text('La simulation ' + pMapping2[month] + ' :' || '/');
                        $('#Cible1').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#Cible2').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                        $('#ecartName').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                        $('#ecartND').val(response.ecart + ' %' || '/');
                        $('#ecartND2').val(response.ecart2 + ' %' || '/');

                        if (response.ecartType =='positif') {
                            $('#performantND').text("Performant");
                            $('#ecartND').removeClass('bg-danger').addClass('bg-success');
                            $('#performantND-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_ND_Icon_').removeClass('d-none').addClass('d-block');
                            $('#performant_ND_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }if (response.ecartType =='négatif'){
                            $('#performantND').text("Non performant");
                            $('#ecartND').removeClass('bg-success').addClass('bg-danger');
                            $('#performantND-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_ND_Icon_').removeClass('d-block').addClass('d-none');
                        } 


                        if (response.ecartType2 =='positif') {
                            $('#performantND2').text("Performant");
                            $('#ecartND2').removeClass('bg-danger').addClass('bg-success');
                            $('#performantND2-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_ND_Icon2_').removeClass('d-none').addClass('d-block');
                            $('#performant_ND_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }if (response.ecartType2 =='négatif'){
                            $('#performantND2').text("Non performant");
                            $('#ecartND2').removeClass('bg-success').addClass('bg-danger');
                            $('#performantND2-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_ND_Icon2_').removeClass('d-block').addClass('d-none');
                        } 
                        
                    }
                    else 
                    {

                        $('#numDenom').removeClass('d-block').addClass('d-none');
                        $('#chiffre').removeClass('d-none').addClass('d-block');
                        $('#typeC').text(unitMapping[response.uniteC] || '/');

                        $('#chifr').text(response.libChiffre || '/');
                        $('#ResultChiffre').val(response.valChiffre || '/');
                        $('#formuleChiffre').text('La formule de calcul: ' + (response.formule || '/'));
                        $('#cibleNameCH').text('Cible ' + (pMapping2[month] + ' :' || '/'));
                        $('#simuCH').text(('La simulation ' + pMapping2[month] + ' :' || '/'));
                        $('#Cible2CH').val((response.cible || '') + ' ' + (response.cibleUnite || ''));
                        $('#Cible2CH_P').val((response.cible2 || '') + ' ' + (response.cibleUnite || ''));

                        $('#ecartNameCH').text('Ecart ' + (pMapping[month] + ' :' || '/'));
                        $('#ecartC').val(response.ecart + ' %' || '/');
                        $('#ecartC2').val(response.ecart2 + ' %' || '/');


                        if (response.ecartType =='positif') {
                            $('#performantC').text("Performant");
                            $('#ecartC').removeClass('bg-danger').addClass('bg-success');
                            $('#performantC-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_CH_Icon_').removeClass('d-none ').addClass('d-block');
                            $('#performant_CH_Icon').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');
                        }
                        if(response.ecartType =='négatif'){
                            $('#performantC').text("Non performant");
                            $('#ecartC').removeClass('bg-success').addClass('bg-danger');
                            $('#performantC-BG').removeClass('bg-success').addClass('bg-danger');
                        }

                        if (response.ecartType2 =='positif') {
                            $('#performantC2').text("Performant");
                            $('#ecartC2').removeClass('bg-danger').addClass('bg-success');
                            $('#performantC2-BG').removeClass('bg-danger').addClass('bg-success');
                            $('#performant_CH_Icon2_').removeClass('d-none').addClass('d-block');
                            $('#performant_CH_Icon2').html('<i class="fa-solid fa-thumbs-up fa-beat text-success"></i>');

                            
                        }
                        if(response.ecartType2 =='négatif') {
                            $('#performantC2').text("Non performant");
                            $('#ecartC2').removeClass('bg-success').addClass('bg-danger');
                            $('#performantC2-BG').removeClass('bg-success').addClass('bg-danger');
                            $('#performant_CH_Icon2_').removeClass('d-block').addClass('d-none');
                        }

                    }
                    ////////////// END test type ///////////////////////////////////

                    ////////////// START Ecart test /////////////////////////////////
                    if (response.ecartType === 'négatif---' ) 
                    {

                        document.getElementById('CDC').style.display = 'block';
                        document.getElementById('CDR').style.display = 'block';

                        if (response.causesDc.length > 0) 
                        {
                            for (let i = 0 ; i<response.causesDc.length ; i++)

                            {
                                var newRow = dataTableCsDc.row.add([
                                    response.causesDc[i].lib_dir,    
                                    response.causesDc[i].lib_cause,
                                    response.causesDc[i].lib_correct,
                                    ]).draw(false).node();
                                    newRow.id = 'cause'+i;
                            }
                                
                        }

                        if (response.causesDr.length > 0) 
                        {
                            for (let i = 0 ; i<response.causesDr.length ; i++)

                            {
                                var newRow = dataTableCsDc.row.add([
                                    response.causesDr[i].lib_dir,    
                                    response.causesDr[i].lib_cause,
                                    response.causesDr[i].lib_correct,
                                    ]).draw(false).node();
                                    newRow.id = 'cause'+i;
                            }
                                
                        }
                    } 
                    else
                    {
                    document.getElementById('CDC').style.display = 'none';
                    document.getElementById('CDR').style.display = 'none';
                    }
                    ////////////// END Ecart test /////////////////////////////////



                    ///////////// START ACTION DC  //////////////////////////////////
                    response.actionsDc.forEach(function(action)
                    {
                            var startDate = new Date(action.dd);
                            var endDate = new Date(action.df);

                            let JSdate = @json($JSdate);
                            var currentDate = new Date(JSdate);

                            var totalDuration = endDate.getTime() - startDate.getTime();
                            var tempEcolAct;

                            if (currentDate < startDate) {
                                tempEcolAct = 0;
                            } else if (currentDate <= endDate) {
                                var currentDuration = currentDate.getTime() - startDate.getTime();
                                tempEcolAct = ((currentDuration / totalDuration) * 100);
                            } else {
                                tempEcolAct = 100;
                            }

                            actColorTime = colorTime (tempEcolAct);
                            actColorEtat = colorStat (action.etat);
                            
                            if(action.etat == null)
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTML = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolAct.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolAct+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTime+'" style="width: ' + tempEcolAct + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +action.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +action.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtat+'" style="width: ' + action.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }


                            response.act_cops.forEach(function(act_cop)
                            {
                                if(action.id_act == act_cop.id_act)
                                {
                                    var startDate = new Date(action.dd);
    
                                    var formattedStartDate = startDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                                    var endDate = new Date(action.df);
    
                                    var formattedEndDate = endDate.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });
    
    
                                    var newRow = dataTable.row.add([
                                    act_cop.lib_dc,
                                    act_cop.lib_act_cop,
                                    formattedStartDate,
                                    formattedEndDate,
                                    progressBarHTML,
                                    ]).draw(false).node();
                                    newRow.id = action.id_act;
    
                                }
                            });


                    });
                    //////////// END ACTION DC ///////////////////////////////////////

                    ///////////// START ACTION DR  //////////////////////////////////
                    response.actionsDr.forEach(function(actiondr)
                    {
                        var startDate = new Date(actiondr.dd);
                        var endDate = new Date(actiondr.df);

                        let JSdate = @json($JSdate);
                        var currentDate = new Date(JSdate);

                        var totalDuration = endDate.getTime() - startDate.getTime();
                        var tempEcolAct;

                        if (currentDate < startDate) {
                            tempEcolActDr = 0;
                        } else if (currentDate <= endDate) {
                            var currentDuration = currentDate.getTime() - startDate.getTime();
                            tempEcolActDr = ((currentDuration / totalDuration) * 100);
                        } else {
                            tempEcolActDr = 100;
                        }

                        actColorTimeDr = colorTime (tempEcolActDr);
                        actColorEtatDr = colorStat (actiondr.etat);
                    

                        if(actiondr.etat == null)
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar ' +actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
    
                                            '<div class="d-flex justify-content-center mt-1" style="flex-direction: column">' +
                                                '<div class="text-center"> <span class="opacity-7 "><i data-feather="alert-triangle" class="text-danger"></i></span> </div>' +
                                                '<div class="progress border border-danger border-2" role="progressbar" aria-label="example" aria-valuenow="' +0+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar " style="width: ' + 0 + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                        
                            }
                            else
                            {
                                var progressBarHTMLDr = '<div style="width: 90% ">' +
                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Temps écoulé : <span class="text-danger">' +tempEcolActDr.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress " role="progressbar" aria-label="Animated striped example" aria-valuenow="' +tempEcolActDr+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorTimeDr+'" style="width: ' + tempEcolActDr + '%"></div>' +
                                                '</div>' +
                                            '</div>' +

                                            '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                '<div class="fs-6 text-secondary"> Avancement : <span class="text-success">' +actiondr.etat.toFixed(2)+ '%</span></div>' +
                                                '<div class="progress border border-success border-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="' +actiondr.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                    '<div class="progress-bar '+actColorEtatDr+'" style="width: ' + actiondr.etat + '%"></div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                            }

                        
                        //  get directions name //////////////////////////////////////////////////////////////////////////
                        response.directionsDr.forEach(function(direction)
                        {
                            if(actiondr.id_dr == direction.id_dir)
                            {
                                var ddDate = new Date(actiondr.dd);
                                var formattedDD = ("0" + ddDate.getDate()).slice(-2) + "/" + ("0" + (ddDate.getMonth() + 1)).slice(-2) + "/" + ddDate.getFullYear();

                                var dfDate = new Date(actiondr.df);
                                var formattedDF = ("0" + dfDate.getDate()).slice(-2) + "/" + ("0" + (dfDate.getMonth() + 1)).slice(-2) + "/" + dfDate.getFullYear();

                                var newRow = dataTableDr.row.add([
                                direction.lib_dir,
                                actiondr.lib_act_cop_dr,
                                formattedDD,
                                formattedDF,
                                progressBarHTMLDr,
                                ]).draw(false).node();
                                newRow.id = actiondr.id_act_cop_dr;

                            }
                        });

                    });
                    ///////////// END ACTION DR  /////////////////////////////////////
                }

            });
        });



    ////////////////////END Indicateur Selector ///////////////////////////////////////////////////////////////////

    });


    ///////////// Start get sub table Dc /////////////////////////////////////////////////////////////////////////////
    $(document).ready(function()
    {
        var dataTable = $('#actCop').DataTable();

        function getFrenchMonthName(monthNumber) {
            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];
            return months[monthNumber - 1];
        }
        function format(infos) {
            var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
            '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                    '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                    '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                    '<th style="width: 25% !important;">Contraintes</th>' +
                    '<th style="width: 15% !important;">Mois</th>' +
                    '<th style="width: 15% !important;">Date de remplissage</th>' +
                    '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
            '</thead>' +
            '<tbody >';

            infos.forEach(function(info)
            {
                var date = new Date(info.date);
                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                var updateDate = '';
                if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                    var update = new Date(info.date_update);
                    updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                }

                var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                var descMonth = new Date(info.date).getMonth() -1;
                // var mm1 = descMonth - 1;
                // var mm2 = descMonth - 2;
                    console.log('descMonth:', descMonth, 'info.mois:', info.mois);
                var moisHtml = '';
                if (info.mois <= descMonth) {
                    moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                } else {
                    moisHtml = '<span>' + formattedDate + '</span>';
                }




                if (info.faite == '/' && info.a_faire =='/' && info.probleme == '/') {
                    
                }else{

                    var faite = info.faite ? info.faite : '';
                    var a_faire = info.a_faire ? info.a_faire : '';
                    var probleme = info.probleme ? info.probleme : '';

                    html += '<tr>' +
                                '<td class="td1">' + faite + '</td>' +
                                '<td class="td2">' + a_faire + '</td>' +
                                '<td class="td3">' + probleme + '</td>' +
                                '<td class="td4">' + moisName + '</td>' +
                                '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                                '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                        '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                        '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                            '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                        '</div>' +
                                                    '</div>' +
                                '</td>' +
                        '</tr>';
                }
            });

            html += '</tbody>' + '</table>';
            return html;
        }

        // Event listener to toggle child rows ///////////////////////////////////////////////////////
        $('#actCop tbody').on('click', 'td', function()
        {
            var tr = $(this).closest('tr');
            var row = dataTable.row(tr);

            var act = $(this).closest('tr').attr('id');

            if (row.child.isShown())
            {

                row.child.hide();
                tr.removeClass('shown');
            }
            else
            {
                // Close any open rows
                dataTable.rows().every(function() {
                    if (this.child.isShown())
                    {
                        this.child.hide();
                        $(this.node()).removeClass('shown');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ url("/subtable") }}/' + act,
                    success: function(response)
                    {
                        var subtableHtml = format(response.infos);
                        row.child(subtableHtml).show();
                        tr.addClass('shown');
                    },
                    error: function(xhr, status, error)
                    {
                        console.error('Error fetching data:', error);
                    }
                });
            }
        });
    });
    //////////// END get sub table Dc ///////////////////////////////////////////////////////////////////////////////


    ///////////// Start get sub table Dr ////////////////////////////////////////////////////////////////////////////
    $(document).ready(function()
    {
        var dataTableDr = $('#actCopDr').DataTable();

        function getFrenchMonthName(monthNumber) {
            const months = [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ];
            return months[monthNumber - 1]; 
        }
        function format(infoss) {
            var html = '<table class="table subtable" style="background-color:#f0f3ff;">' +
            '<thead style="background-color:#d7ddf8">' +
                '<tr style="color:#6c6c6c;">' +
                    '<th style="width: 25% !important;">Ce qui a été fait</th>' +
                    '<th style="width: 25% !important;">Ce qui reste a faire</th>' +
                    '<th style="width: 25% !important;">Contraintes</th>' +
                    '<th style="width: 15% !important;">Mois</th>' +
                    '<th style="width: 15% !important;">Date de remplissage</th>' +
                    '<th style="width: 10% !important;">Avancement(%)</th>' +
                '</tr>' +
            '</thead>' +
            '<tbody >';

            infoss.forEach(function(info)
            {
                var date = new Date(info.date);
                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false});

                var updateDate = '';
                if (info.date_update && !isNaN(new Date(info.date_update).getTime())) {
                    var update = new Date(info.date_update);
                    updateDate = '<br><span class="text-success me-1">' + update.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' , hour: '2-digit', minute: '2-digit', hour12: false}) + '</span><i class="fa-solid fa-pen fa-sm text-success"></i>';
                }

                var moisName = getFrenchMonthName(parseInt(info.mois, 10));

                var descMonth = new Date(info.date).getMonth() -1;
                
                    console.log('descMonth:', descMonth, 'info.mois:', info.mois);
                var moisHtml = '';
                if (info.mois <= descMonth) {
                    moisHtml = '<span class="me-1">' + formattedDate + '</span> <span style="color: rgb(255, 96, 96);"><i class="fa-solid fa-stopwatch fa-lg"></i></span>';
                } else {
                    moisHtml = '<span>' + formattedDate + '</span>';
                }

                if (info.faite == '/' && info.a_faire =='/' && info.probleme == '/') {
                    
                }else{

                    var faite = info.faite ? info.faite : '';
                    var a_faire = info.a_faire ? info.a_faire : '';
                    var probleme = info.probleme ? info.probleme : '';

                    html += '<tr>' +
                            '<td class="td1">' + faite + '</td>' +
                            '<td class="td2">' + a_faire + '</td>' +
                            '<td class="td3">' + probleme + '</td>' +
                            '<td class="td4">' + moisName + '</td>' +
                            '<td class="td4dr">' + moisHtml + (info.date_update !== '' ? updateDate : '') + '</td>' +
                            '<td class="td5"> '+ '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                                    '<div class="fs-6 text-success">' +info.etat.toFixed(2)+ '%</div>' +
                                                    '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                                        '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                                    '</div>' +
                                                '</div>' +
                            '</td>' +
                    '</tr>';
                }
                
            });

            html += '</tbody>' + '</table>';
            return html;
        }

        // Event listener to toggle child rows //////////////////////////
        $('#actCopDr tbody').on('click', 'td', function()
        {
            var tr = $(this).closest('tr');
            var row = dataTableDr.row(tr);

            var act = $(this).closest('tr').attr('id');

            if (row.child.isShown())
            {

                row.child.hide();
                tr.removeClass('shown');
            }
            else
            {
                // Close any open rows
                dataTableDr.rows().every(function() {
                    if (this.child.isShown())
                    {
                        this.child.hide();
                        $(this.node()).removeClass('shown');
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ url("/subtableDr") }}/' + act,
                    success: function(response)
                    {
                        console.log(response.infoss)


                        var subtableHtml = format(response.infoss);
                        row.child(subtableHtml).show();
                        tr.addClass('shown');
                    },
                    error: function(xhr, status, error)
                    {
                        console.error('Error fetching data:', error);
                    }
                });
            }
        });
    });
    ///////////// END get sub table dr //////////////////////////////////////////////////////////////////////////////

    window.onload = function() {
        document.getElementById('Objectif').selectedIndex = 0;
    };
