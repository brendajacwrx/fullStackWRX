<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Anderson Assignment 1 </title>
  </head>
  <body>
    <div class="container">
        <form>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="validationDefault01">First name</label>
                <input type="text" class="form-control" id="validationDefault01" value="" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="validationDefault02">Last name</label>
                <input type="text" class="form-control" id="validationDefault02" value="" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="validationDefault03">City</label>
                <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-3 mb-3">
                <label for="validationDefault04">State</label>
                <select class="custom-select" id="validationDefault04" required>
                    <option value="California">California</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Indiana">Indiana</option>
                    <option selected value="Michigan">Michigan</option>
                    <option value="South Carolina">South Carolina</option>
                </select>
                </div>
                <div class="col-md-3 mb-3">
                <label for="validationDefault05">Zip</label>
                <input type="text" class="form-control" id="validationDefault05" required>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Register</button>
        </form> <!-- form -->
    </div> <!-- container -->
  </body>
</html>