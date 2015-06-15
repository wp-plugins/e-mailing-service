
function isset(varname)
{
  return(typeof(window[varname])!='undefined');
}

Array.prototype.in_array = function(val) {
   for (var i in this) {
      if (this[i] == val) return true;
       }
   return false;
};

function setorg(form)
{
}

function coo_setorg(form)
{
    var aob = new Array( 'Saisie obligatoire', 'Mandatory field', 'Introducción obligatoria', 'Obligatorische Eingabe' );

	if ( form.coo_formejuridique.value == 'Particulier' ) {
		form.coo_societe.value = "";
		form.coo_siret.value = "";
		form.coo_numero_tva.value = "";
		form.coo_societe.disabled = true;
		form.coo_numero_tva.disabled = true;
		form.coo_siret.disabled = true; 

        if ( form.coo_ne_le != undefined ) {
            form.coo_ne_le.disabled = false;
            form.coo_ne_cp.disabled = false;
            form.coo_ne_ville.disabled = false;
            form.coo_ne_pays_id.disabled = false;
/*
            form.coo_ne_le.value = "";
            form.coo_ne_cp.value = "";
            form.coo_ne_ville.value = "";
            form.coo_ne_pays_id.value = "";
*/
            }

        if ( form.coo_duns != undefined ) {
    		form.coo_duns.disabled = true; 
            form.coo_local.disabled = true; 
/*
            form.coo_duns.value = "";
    		form.coo_local.value = "";
*/
            }

        if ( form.coo_publication_jo != undefined ) {
            form.coo_publication_jo.disabled = true;
            form.coo_publication_jo_page.disabled = true;
            }

        form.coo_societe.setAttribute('class','input_2');
        form.coo_numero_tva.setAttribute('class','input_2');
        form.coo_siret.setAttribute('class','input_2');
        if ( form.coo_duns != undefined ) form.coo_duns.setAttribute('class','input_2');
        if ( form.coo_local != undefined ) form.coo_local.setAttribute('class','input_2');
		}
    /* Societe ou Association */
	else {
        var va_societe = form.coo_societe.getAttribute('class');
        var va_numero_tva = form.coo_numero_tva.getAttribute('class');
        var va_siret = form.coo_siret.getAttribute('class');
        var va_duns = "";
        var va_local = "";
        var va_jo = "";
        var va_jo_page = "";
        if ( form.coo_duns != undefined ) va_duns = form.coo_local.getAttribute('class');
        if ( form.coo_local != undefined ) va_local = form.coo_duns.getAttribute('class');

        if ( form.coo_formejuridique.value == 'Association' && form.coo_publication_jo != undefined ) {
                va_jo = form.coo_publication_jo.getAttribute('class');
                va_jo_page = form.coo_publication_jo.getAttribute('class');
                form.coo_publication_jo.disabled = false;
                form.coo_publication_jo_page.disabled = false;
            }
        else
        if ( form.coo_formejuridique.value != 'Association'  && form.coo_publication_jo != undefined ) {
            form.coo_publication_jo.disabled = true;
            form.coo_publication_jo_page.disabled = true;
            }

        if ( form.coo_ne_le != undefined ) {
            form.coo_ne_le.disabled = true;
            form.coo_ne_cp.disabled = true;
            form.coo_ne_ville.disabled = true;
            form.coo_ne_pays_id.disabled = true;
            }

		form.coo_societe.disabled = false;
		form.coo_numero_tva.disabled = false;
		form.coo_siret.disabled = false;
        if ( form.coo_duns != undefined ) form.coo_duns.disabled = false;
		if ( form.coo_local != undefined ) form.coo_local.disabled = false;

        
        if ( form.coo_formejuridique.value == 'Societe' && form.coo_formejuridique.disabled == true ) {
    		form.coo_siret.disabled = true;
            if ( form.coo_duns != undefined ) form.coo_duns.disabled = true;
    		if ( form.coo_local != undefined ) form.coo_local.disabled = true;
            }

        if ( va_societe != 'inputerror' ) va_societe = 'input_1';
        if ( va_numero_tva != 'inputerror' ) va_numero_tva = 'input_1';
        if ( va_siret != 'inputerror' ) va_siret = 'input_1';
        if ( va_duns != 'inputerror' ) va_duns = 'input_1';
        if ( va_local != 'inputerror' ) va_local = 'input_1';

        if ( aob.in_array( form.coo_societe.value )===true )
            form.coo_societe.setAttribute('class', 'inputerror' );
        else 
            form.coo_societe.setAttribute('class', va_societe );

        form.coo_numero_tva.setAttribute('class', va_numero_tva );
        form.coo_siret.setAttribute('class', va_siret );

        if ( form.coo_duns != undefined ) form.coo_duns.setAttribute('class', va_duns );
        if ( form.coo_local != undefined ) form.coo_local.setAttribute('class', va_local );
		}
}

function coo_controlform( )
{
    // controle editable ou non realise par le programme, elimine ici les pb de retour saisie vide.
	document.forms["coordonnee"].coo_formejuridique.disabled = false;
	document.forms["coordonnee"].coo_nom.disabled = false;
	document.forms["coordonnee"].coo_prenom.disabled = false;
	document.forms["coordonnee"].coo_societe.disabled = false;
	document.forms["coordonnee"].coo_numero_tva.disabled = false;
	document.forms["coordonnee"].coo_siret.disabled = false;
	document.forms["coordonnee"].coo_duns.disabled = false;
	document.forms["coordonnee"].coo_local.disabled = false;

    // FR 'Saisie obligatoire'
    // EN 'Mandatory field'
    // ES 'Introducción obligatoria'
    // DE 'Obligatorische Eingabe'

    var aob = new Array( 'Saisie obligatoire', 'Mandatory field', 'Introducción obligatoria', 'Obligatorische Eingabe' );

    if ( aob.in_array( document.forms["coordonnee"].coo_nom.value ) === true )
        document.forms["coordonnee"].coo_nom.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_prenom.value ) === true )
        document.forms["coordonnee"].coo_prenom.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_societe.value ) === true )
        document.forms["coordonnee"].coo_societe.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_adresse1.value ) === true )
        document.forms["coordonnee"].coo_adresse1.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_cp.value ) === true )
        document.forms["coordonnee"].coo_cp.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_ville.value ) === true )
        document.forms["coordonnee"].coo_ville.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_email.value ) === true )
        document.forms["coordonnee"].coo_email.value='';

    if ( aob.in_array( document.forms["coordonnee"].coo_telephone.value ) === true )
        document.forms["coordonnee"].coo_telephone.value='';

    if (document.forms["coordonnee"].coo_ne_le != undefined ) {
        if ( aob.in_array( document.forms["coordonnee"].coo_ne_le.value ) === true )
            document.forms["coordonnee"].coo_ne_le.value='';
        }
    if (document.forms["coordonnee"].coo_ne_cp != undefined ) {
        if ( aob.in_array( document.forms["coordonnee"].coo_ne_cp.value ) === true )
            document.forms["coordonnee"].coo_ne_cp.value='';
        }
   if (document.forms["coordonnee"].coo_ne_ville != undefined ) {
        if ( aob.in_array( document.forms["coordonnee"].coo_ne_ville.value ) === true )
            document.forms["coordonnee"].coo_ne_ville.value='';
        }
}

function coo_setregion(form)
{

	//  7 | ÉTATS-UNIS D'AMERIQUE
	if ( form.coo_pays_id.value == 7 ) {
		form.coo_region_id.disabled = false;
        form.coo_region_id.setAttribute('class','input_1');

		for (var i=form.coo_region_id.options.length-1;i>form.coo_region_id.options.selectedIndex;i--) {
			if ( form.coo_region_id.options[i].value >= 7000 && form.coo_region_id.options[i].value <= 8000 ) {
				form.coo_region_id.options[i].disabled=false;
                form.coo_region_id.setAttribute('class','input_1');
                }
			else {
				form.coo_region_id.options[i].disabled=true;
                form.coo_region_id.setAttribute('class','input_2');
                }
			}
		}
	else
	// 30 | AUSTRALIE
	if ( form.coo_pays_id.value == 30 ) {
		form.coo_region_id.disabled = false;
        form.coo_region_id.setAttribute('class','input_1');

		for (var i=form.coo_region_id.options.length-1;i>form.coo_region_id.options.selectedIndex;i--) {
				if ( form.coo_region_id.options[i].value >= 30000 && form.coo_region_id.options[i].value <= 31000 ) {
					form.coo_region_id.options[i].disabled=false;
                    form.coo_region_id.setAttribute('class','input_1');
                    }
				else {
					form.coo_region_id.options[i].disabled=true;
                    form.coo_region_id.setAttribute('class','input_2');
				    }
				}

		}
	else
	// 54 | CANADA
	if ( form.coo_pays_id.value == 54 ) {
		form.coo_region_id.disabled = false;
        form.coo_region_id.setAttribute('class','input_1');

		for (var i=form.coo_region_id.options.length-1;i>form.coo_region_id.options.selectedIndex;i--) {
				if ( form.coo_region_id.options[i].value >= 54000 && form.coo_region_id.options[i].value <= 55000 ) {
					form.coo_region_id.options[i].disabled=false;
                    }
				else {
					form.coo_region_id.options[i].disabled=true;
                    form.coo_region_id.setAttribute('class','input_2');
				    }
				}

		}
	else
	// 113 | INDE
	if ( form.coo_pays_id.value == 113 ) {
		form.coo_region_id.disabled = false;
        form.coo_region_id.setAttribute('class','input_1');

		for (var i=form.coo_region_id.options.length-1;i>form.coo_region_id.options.selectedIndex;i--) {
				if ( form.coo_region_id.options[i].value >= 113000 && form.coo_region_id.options[i].value <= 114000 ) {
					form.coo_region_id.options[i].disabled=false;
                    form.coo_region_id.setAttribute('class','input_1');
                    }
				else {
					form.coo_region_id.options[i].disabled=true;
                    form.coo_region_id.setAttribute('class','input_2');
                    }
				}
		}
	else {
		form.coo_region_id.disabled = true;
        form.coo_region_id.setAttribute('class','input_2');
		form.coo_region_id.value = 0;
		}
}

function cooselect_setcidhandle(form)
{
    form.form_select_societe.value = 0;
    form.form_select_societe.value = form.form_select_handle.value;
    form.form_select_nom.value = form.form_select_handle.value;
}

function cooselect_setcidsociete(form)
{
    form.form_select_handle.value = form.form_select_societe.value;
    form.form_select_nom.value = form.form_select_societe.value;
}


function cooselect_setcidnom(form)
{
    form.form_select_societe.value = 0;
    form.form_select_societe.value = form.form_select_nom.value;
    form.form_select_handle.value = form.form_select_nom.value;
}


function rweb_redirmode(form)
{

    if ( document.forms["rweb"].rweb_viaframe.checked == true )
        document.forms["rweb"].rweb_type.disabled = true;
    else 
        document.forms["rweb"].rweb_type.disabled = false;

}

