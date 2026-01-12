async function fetchDataGet(url, returnValue) {
  try {
    const response = await fetch(url)

    if(!returnValue){
      return console.log(response)
    }
    return await response.json();

  } catch (error) {
    console.log(error)
  }
}
//TO-DO
//Pasar como parametro el content type para ponerlo en el header de la petición
async function fetchDataPost(url, params, returnValue) {

  try {
    const response = await fetch(url, {
      method: "POST",
      body: params
    })

    if(!returnValue){
      return console.log(response)
    }
    
    return await response.json();

  } catch (error) {
    console.log(error)
  }
    
}

function isLogged() {

}

function showMessage() {

  let sp = new URLSearchParams(window.location.search);
  
  if (sp.has("proc")) {
    //Create the element that will contain the message
    let messageElement = document.createElement("div");
    messageElement.classList.add("bg-primary", 
                                 "w-110", 
                                 "flex", 
                                 "justify-center", 
                                 "items-center", 
                                 "py-5", 
                                 "rounded-md", 
                                 "gap-2",
                                 "opacity-0",
                                 "-translate-y-3",
                                 "transition-all",
                                 "duration-300",
                                 "ease-out");

    // Create the icon of the message      
    const icon = document.createElement("i");

    if(sp.get("proc") === "successfull"){
      icon.classList.add("fa-solid", "fa-check", "text-green-600");
    } else {
      icon.classList.add("fa-solid", "fa-x", "text-red-600");
    }
    messageElement.appendChild(icon);

    //Create the text content of the message
    const msgElement = document.createElement("p");
    msgElement.classList.add("text-text", "font-bold");
    msgElement.textContent = sp.get("msg");

    messageElement.appendChild(msgElement);

    //Finally append the message in the container where contains all the messages
    document.getElementById("messages-container").appendChild(messageElement);
    
    //Animation of the message
    requestAnimationFrame(() => {
      messageElement.classList.remove("opacity-0", "-translate-y-3");
      messageElement.classList.add("opacity-100", "translate-y-0");
    });
    
    // Set a time out to hide the message
    setTimeout(() => {
      messageElement.classList.remove("opacity-100", "translate-y-0");
      messageElement.classList.add("opacity-0", "-translate-y-3");

      setTimeout(() => messageElement.remove(), 300);
    }, 4000);
      
  }

}