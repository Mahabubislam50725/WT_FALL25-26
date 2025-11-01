<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            font-size:30px;
            background-color:green;
            font-style:italic;
            border: 3px solid red;
        
        }
    </style>
</head>
<body style=background-color:black;color:white>

        <h1 style=text-align:center;font-size:40px;>Information Page</h1>
   <form >
    <center>
    <table>
     
      <tr>
        <td>
            Username
        </td>
        <td>
            <input type="text">
        </td>
      </tr>
      <tr>
        <td>
            PassWord
        </td>
        <td>
            <input type="password">
        </td>
      </tr>
      <tr>

        <td> Email</td>
        <td><input type="text"></td>

      </tr>
      <tr>
        <td>ID</td>
        <td>
            <input type="number">
        </td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>
            <input type="radio" name="radio">Male
            <input type="radio" name="radio">Female
            <input type="radio" name="radio">other
    </td>
      </tr>

      <tr>
        <td>Dept</td>
        <td>
            <select >
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="IPE">IPE</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>
            Extra
        </td>
        
            <td>
            <input type="checkbox" name="extra">one
            <input type="checkbox" name="extra">two
            <input type="checkbox" name="extra">three
           </td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file"></td>
        </tr>
        <tr>
            <td>
                DOB
            </td>
            <td><input type="date"></td>
        </tr>
        <tr>
            <td>
                Address
            </td>
            <td>
                <textarea></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="button" name="" value="Click"/>
                <input type="submit" name="" value="Submit"/>
                <input type="reset" name="" value="Reset"/>
            </td>
        </tr>
        
      </table>
      </center>
</form>

</body>
</html>