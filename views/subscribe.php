<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kopokopo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Kopokopo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Webhooks
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/webhook/subscribe">Webhook Subscribe</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <br>

    <div class="container">
        <form id="bulkSmsForm"(action="/webhook/subscribe", method="post")>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" (for="event_type")> Event Type </label>
                <div class="col-sm-7">
                    <select name = "event_type">
                        <option value="buy_goods_received"> Buy Goods Received </option>
                        <option value="buy_goods_reversed"> Buy Goods Reversed </option>
                        <option value="settlement_completed"> Settlement Completed </option>
                        <option value="customer_created"> Customer Created </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" (for="url")> URL </label>
                <div class="col-sm-7">
                    <input class="form-control" name="url"  type='text' placeholder='Enter URL' required/>
                    <div class="small form-text text-muted">
                        Enter the webhook url
                    </div>
                </div>
            </div>
            <br/>
            <div class="form-group.row">
                <div class="col-sm-7">
                    <button class="btn btn-success"(type='submit')> Subscribe
                </div>
            </div>
        </form>
    </div> 

</body>
</html>
