<h1>Patient List</h1>

<table>
    <thead style="text-align: left;">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Sex</th>
            <th>Birth place</th>
            <th>Country of birth</th>
            <th>Date of birth</th>
            <th>UMNP</th>
            <th>Mobile phone number</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($patients as $patient):?>  <!--patients is the name of value that we specify inside our controller-->
        <tr>
            <td>
                <?php echo $patient['id']?>
            </td>
            <td>
                <?php echo $patient['ime']?>
            </td>
            <td>
                <?php echo $patient['prezime']?>
            </td>
            <td>
                <?php echo $patient['pol']?>
            </td>
            <td>
                <?php echo $patient['mesto_rodjenja']?>
            </td>
            <td>
                <?php echo $patient['drzava_rodjenja']?>
            </td>
            <td>
                <?php echo $patient['datum_rodjenja']?>
            </td>
            <td>
                <?php echo $patient['JMBG']?>
            </td>
            <td>
                <?php echo $patient['telefon']?>
            </td>
            <td>
                <?php echo $patient['email']?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>