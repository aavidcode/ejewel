<div class="container">
    <div class="row">
        <?php echo form_open('', array('role' => 'form', 'autocomplete' => 'off')); ?>
        <div class="panel panel-default">
            <div class="panel-heading">Registration</div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>EMail Id</th>
                            <th>Mobile</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($userArr as $user) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="users[]" value="' . $user->USER_ID . '" /></td>';
                            echo '<td>' . ($user->FIRST_NAME . ' ' . $user->LAST_NAME) . '</td>';
                            echo '<td>' . $user->USER_NAME . '</td>';
                            echo '<td>' . $user->EMAIL_ID . '</td>';
                            echo '<td>' . $user->MOBILE . '</td>';
                            echo '<td>' . $user->USER_CREATED . '</td>';
                            echo '</tr>';
                        }
                        ?> 
                    </tbody>
                </table>

            </div>
        </div>
        <div class="t_center">
            <button type="submit" class="btn btn-danger">Approve</button>
        </div>
        <?php form_close(); ?>
    </div>
</div>