<?php

    require_once (__DIR__ . '\\..\\..\\libraries\\config.php');
    require_once (__DIR__ . '\\..\\..\\libraries\\database.php');

    if (isset($_POST['choice'])) {

        $db = new DataBase(
            $db_config->hostname,
            $db_config->username,
            $db_config->password,
            $db_config->database
        );
                
        $choices = [
            'option1' => strval($_POST['option1']),
            'option2' => strval($_POST['option2']),
            'option3' => strval($_POST['option3']),
            'choice'  => strval($_POST['choice'])
        ];

        return $db->saveChoices($choices);
    } 

?>

<div class="modal fade" id="popup" role="dialog" aria-labelledby="popupModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="popupModal">Ready to Accept?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">  
                <p> This email address is very important with your decision.</p>
                <div class="form-group row">          
                    <label class="col-lg-2" for='email'>
                        <span>Email</span>
                    </label>            
                    <input class="form-control col-lg-9" id='email' type='text' placeholder="Input your E-mail address"/>  
                </div>

                <input id='one' type='checkbox' />
                <label for='one'>
                    <span></span>Option 1
                </label>
                <input id='two' type='checkbox' />
                <label for='two'>
                    <span></span>Option 2
                </label>
                <input id='three' type='checkbox' />
                <label for='three'>
                    <span></span>Option 3
                </label>

                <p>Select "Accept" below if you are ready to submit your current decision.</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-decline">Decline</button>
                <button class="btn btn-primary btn-accept">Accept</button>
            </div>

        </div>
    </div>
</div>