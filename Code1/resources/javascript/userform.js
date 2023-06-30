window.onload = () =>{
    const select = document.getElementById("tipo");
    const form = document.getElementById("userform");
    var selected = "";
    select.onchange = () =>{
        console.log("mudou");
        selected = select.value;
        
        switch (selected) {
            case "medico":
                div = form.getElementsByTagName("div");
                while (div.firstChild) {
                    parent.firstChild.remove()
                }
                //criar todos os elementos todas as vezes e apagar todos
                //sempre que mudar 
                // Create a new input element
                var inputElement = document.createElement('input');

                // Set attributes for the input element
                inputElement.type = 'text';
                inputElement.id = 'myInput';
                inputElement.name = 'myInput';

                // Add the input element to the document body
                div.appendChild(inputElement);
                break;
        
            default:
                break;
        }
    }
}