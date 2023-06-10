function createSearchForm() {
    // Create text field
    const table_row = document.getElementById("function-row");

    const new_form = document.createElement("form");
    new_form.setAttribute('id', 'search-form');
    new_form.setAttribute('class', 'input-container m-2 p-2');
    new_form.setAttribute('action', './Contacts/php/find_user.php');
    new_form.setAttribute('method', 'post');

    table_row.appendChild(new_form);


    const textField = document.createElement("input");
    textField.type = "text";
    textField.placeholder = "user#user-id";
    textField.setAttribute('width', '100%');
    textField.setAttribute('name', 'user');
    
    // Create submit button
    const submitButton = document.createElement("button");
    submitButton.type = "submit";
    submitButton.value = "🔎︎";
    submitButton.setAttribute("class", "login-button input-button m-1 p-1");
    
    // Append elements to a container div
    new_form.appendChild(textField);
    new_form.appendChild(submitButton);

    var addButton = document.getElementById("addButton");
    addButton.remove(addButton);

}

const addButton = document.getElementById("addButton");
addButton.addEventListener("click", createSearchForm);
