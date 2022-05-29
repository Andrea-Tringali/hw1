function onJson1(json) {
  console.log(json);

  const library = document.querySelector('#book-list');
  library.innerHTML = '';
  library.classList.remove('hidden');
  
  let results = json.totalItems;

  for(let i=0; i<results ; i+=1){
      const result=json.items[i];
      const author=result.volumeInfo.authors;
      const title1=result.volumeInfo.title;
      const img_book = (result.volumeInfo.imageLinks) ? result.volumeInfo.imageLinks.thumbnail : placeHldr;
      img_url = img_book;
      
      const oggetto=document.createElement('div');
      oggetto.classList.add('box-book');

      const autore=document.createElement('h2');
      autore.classList.add('autore');
      autore.textContent=author;
      
      const titolo=document.createElement('h1');
      titolo.classList.add('titolo');
      titolo.textContent=title1;

      const img = document.createElement('img');
      img.src=img_book;

      id = document.createElement('p');
      id.textContent = result.id;
      id.classList.add('hidden');
      
      let pref;
      fetch("is_pref.php?id=" + result.id).then(onResponse1).then(json => {
        pref = json.preferito;
        const preferito = document.createElement('a');
        preferito.classList.add('pre');
      if(pref){
        preferito.innerText= "Già nei preferiti";
        preferito.classList.add('added');
      }else{
        preferito.innerText="Aggiungi ai preferiti";
        preferito.addEventListener('click',addPreferito);
      }
        oggetto.appendChild(preferito);
      });
      
      oggetto.appendChild(img);
      oggetto.appendChild(titolo);
      oggetto.appendChild(autore);
      oggetto.appendChild(id);
      
      library.appendChild(oggetto);
      
    }  
}

  function onJsonPref(json){
    console.log("Aggiunto:" + json.esito);
  }

  function onResponse1(response) {
    console.log('Risposta ricevuta');
    return response.json();
  }

  function search(event){ 
    event.preventDefault(); 
    const libro = document.querySelector('#name').value;
    const l = libro.replace(/\s+/g, '-');
    const libro_title= encodeURIComponent(l);
    
    fetch("get_book.php?book=" + libro_title).then(onResponse1).then(onJson1);
  }

  function addPreferito(event){
    const button = event.currentTarget;
    const formData = new FormData();
    formData.append('id', button.parentNode.querySelector('p').textContent);
    formData.append('img', button.parentNode.querySelector('img').src);
    formData.append('title', button.parentNode.querySelector('.titolo').textContent);
    formData.append('author', button.parentNode.querySelector('.autore').textContent);

    fetch("add_preferiti.php", {method: 'post', body: formData}).then(onResponse1).then(onJsonPref);

    button.parentNode.querySelector('a').innerText = "Aggiunto";
    button.parentNode.querySelector('a').classList.add('added');
  }

  const bottone = document.querySelector('#cerca');
  bottone.addEventListener('submit', search);