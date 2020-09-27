export default function sendRequest(uri, method, request_data, finally_callback, success_callback, err_handler_422) {

    let fetch_init = {
        method: method,
        headers: {'Accept': 'application/json'}
    };

    if (method.toLowerCase() === 'post') {
        fetch_init.body = request_data
    }

    fetch(`${window.location.origin}/coding-test/${uri}`, fetch_init).finally(finally_callback)

        .then((response) => {

                const response_code = response.status;

                response.json().then((response) => {

                    if (response_code === 200) {

                        if (response.has_err && response.message) {
                            alert(response.message);

                        } else {
                            if (response.message) {
                                alert(response.message);
                            }
                            success_callback(response);
                        }

                    } else if (response_code === 422) {
                        err_handler_422(response);

                    } else {
                        console.log(`Something went wrong. Status Code: ${response.status}`);
                        return;
                    }

                });
            }
        ).catch(function (err) {
        console.log('Fetch Error :-S', err);
    });

}
