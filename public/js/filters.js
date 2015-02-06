/**
 * Created by Thibault on 04/02/2015.
 */
jQuery( document ).ready( function( $ ) {

    $( '#form_formateur_filter' ).on( 'submit', function() {
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "firstname": $( 'input[name=firstname]' ).val(),
                "lastname": $( 'input[name=lastname]' ).val(),
                "email": $( 'input[name=email]' ).val(),
                "address": $( 'input[name=address]' ).val(),
                "cp": $( 'input[name=cp]' ).val()
            },
            function( data ) {
                $('#formateur_table tbody').html(data);
            }
        );
        return false;
    } );



    $( '#form_user_filter' ).on( 'submit', function() {
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "firstname": $( 'input[name=firstname]' ).val(),
                "lastname": $( 'input[name=lastname]' ).val(),
                "email": $( 'input[name=email]' ).val(),
                "username": $( 'input[name=username]' ).val(),
                "role": $( 'select[name=role]' ).val()
            },
            function( data ) {
                $('#user_table tbody').html(data);
            }
        );
        return false;
    } );

    $( '#form_student_filter' ).on( 'submit', function() {
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "firstname": $( 'input[name=firstname]' ).val(),
                "lastname": $( 'input[name=lastname]' ).val(),
                "curriculum": $( 'select[name=curriculum]' ).val(),
                "classroom": $( 'select[name=classroom]' ).val()
            },
            function( data ) {
                $('#student_table tbody').html(data);
            }
        );
        return false;
    } );

    $( '#form_curriculum_filter' ).on( 'submit', function() {
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "code": $( 'input[name=code]' ).val(),
                "libelle": $( 'input[name=libelle]' ).val(),
                "time": $( 'input[name=time]' ).val()
            },
            function( data ) {
                $('#curriculum_table tbody').html(data);
            }
        );
        return false;
    } );

    $( '#form_classroom_filter' ).on( 'submit', function() {
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "code": $( 'input[name=code]' ).val(),
                "curriculum": $( 'select[name=curriculum]' ).val()
            },
            function( data ) {
                $('#classroom_table tbody').html(data);
            }
        );
        return false;
    } );

    jQuery( 'input[name=firstname], input[name=lastname], input[name=email], input[name=address], input[name=cp], input[name=username], input[name=code], input[name=libelle], input[name=time]' ).on( 'keyup', function() {
        //fire the form submit event here
        jQuery( '#form_formateur_filter' ).trigger( 'submit' );
        jQuery( '#form_student_filter' ).trigger( 'submit' );
        jQuery( '#form_user_filter' ).trigger( 'submit' );
        jQuery( '#form_curriculum_filter' ).trigger( 'submit' );
        jQuery( '#form_classroom_filter' ).trigger( 'submit' );
    } );

    jQuery( 'select[name=classroom], select[name=curriculum], select[name=role] ' ).on( 'mouseup', function() {
        //fire the form submit event here
        jQuery( '#form_formateur_filter' ).trigger( 'submit' );
        jQuery( '#form_student_filter' ).trigger( 'submit' );
        jQuery( '#form_user_filter' ).trigger( 'submit' );
        jQuery( '#form_curriculum_filter' ).trigger( 'submit' );
        jQuery( '#form_classroom_filter' ).trigger( 'submit' );
    } );

} );