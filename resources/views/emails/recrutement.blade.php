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
                                CANDIDATURE SPONTANEE
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
                                    <td align="left">
                                        <table border="0" width="590" align="center" cellpadding="0" cellspacing="0" class="container590">
                                            <tr>
                                                <td align="left" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                                    <!-- section text ======-->

                                                    <p style="margin-bottom: 5px">
                                                        NOM: {{ $data['nom'] }}
                                                    </p>

                                                    <p style="margin-bottom: 5px">
                                                        PRENOM: {{ $data['prenom'] }}
                                                    </p>
                                                    
                                                    <!-- <h5 style="margin-top: 5px;margin-bottom: 5px;">AUTRE INFORMATION DU CANDIDAT</h5> -->
                                                    <p style="line-height: 24px;margin-bottom:10px;">
                                                       EMAIL: {{ $data['email']}}
                                                    </p>

                                                    <p style="line-height: 24px;margin-bottom:10px;">
                                                       PHONE: {{ $data['phone'] }}
                                                    </p>


                                                    <p style="line-height: 24px;margin-bottom:20px;">
                                                       <a href="{{ $data['fichiers']}}">Voir le cv du postulant</a> 
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                        </table>
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
        