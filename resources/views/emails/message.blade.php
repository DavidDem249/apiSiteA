@extends('emails.base')
         
@section('content')
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                    <tr>
                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
                            class="main-header">
                            <!-- section text ======-->

                            <div style="line-height: 35px">

                                DEMANDE POUR ÊTRE FORMATEUR

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                <tr>
                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="left">
                            <table border="0" width="590" align="center" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                        <!-- section text ======-->

                                        <p style="line-height: 24px; margin-bottom:15px;">
                                            NOM : {{ $data['nom'] }} PRENOM : {{ $data['prenom'] }},
                                        </p>
                                        
                                       <p style="line-height: 24px;margin-bottom:15px;">
                                             MOBILE PHONE : {{ $data['phone'] }}
                                        </p>
                                       
                                        <p style="line-height: 24px">
                                            <span style="color:rgb(115,48,55); font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">DOMAINE DE FORMATION : {{ $data['domaine'] }},</br>
                                            ADRESSE EMAIL : {{ $data['email'] }}</span>
                                        </p>


                                        <p style="line-height: 24px">
                                            <span style="color:rgb(115,48,55); font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">
                                            CURRICULUM VITAE : <embed src="{{ $data['cv'] }}" width=800 height=500 type='application/pdf'/></span>
                                        </p>

                                        <p style="line-height: 24px">
                                            <span style="color:rgb(115,48,55); font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">
                                            DETAILS FORMATION : <embed src="{{ $data['details_formation'] }}" width=800 height=500 type='application/pdf'/></span>
                                        </p>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>

    </table>
@stop      
        