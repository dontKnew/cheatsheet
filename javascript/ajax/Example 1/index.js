window.onload  = function(){

    const xhr = new XMLHttpRequest();

    // true mean its asyn. fetching and false mean  its sysn. fetching 
    xhr.open("GET", 'https://jsonplaceholder.typicode.com/todos/', true) 
 
    // here you can define any loading functionality until fetch data 

    xhr.responseType  = "string";
    xhr.onprogress  = function(){
        console.warn("fetching...") 
    }

    xhr.onreadystatechange = function(){
        console.warn("ready state is", xhr.readyState);
    }
    

    // what to do when response is ready
    xhr.onload = function(){
        if(this.status == 200){
            console.warn(xhr.responseText);
        }else {
            console.warn("soemthing wrong");
        }
    }

    //send the request
    xhr.send();
}