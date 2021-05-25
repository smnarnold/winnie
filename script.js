class Winnie {
  constructor() {
    this.dom = {
      resolutionRadios: document.querySelectorAll('input[name="resolution"]'),
      meme: document.querySelector('.meme'),
      url: document.querySelector('.url'),
      random: document.querySelector('.random'),
      text1: document.querySelector('.text.no1'),
      text2: document.querySelector('.text.no2'),
      source: document.querySelector('.source'),
      download: document.querySelector('.download'),
      hrefDownload: document.querySelector('.href-download'),
    }

    this.index = 0;
    this.resolution = ''; // standard

    fetch('/memes.json')
    .then(res => res.json())
    .then(data => {
      this.memesArr = data;
      this.init();
      this.bindEvents();
    })
  }
  
  init() {
    this.shuffleMemes();
    this.load();
    this.obj = this.memesArr[this.index];
    this.updateMeme(this.obj);
  }

  load() {
    this.path = window.location.pathname.substring(1);

    if (this.path !== '') {
      const slashIndex = this.path.indexOf('/');

      if (slashIndex !== -1) {
        let urlParts = this.path.split("/");
        this.path = urlParts[0];
        const resolution = urlParts[1];
        // this.path = this.path.replace(hash, "");
        //hash = hash.substring(1);
        this.changeResolution(resolution, true);
      }

      this.index = this.memesArr.findIndex(obj => obj.slug === this.path);
    }
  }
  
  shuffleMemes() {
    this.memesArr.sort(() => Math.random() - 0.5);
  }
  
  bindEvents() {
    this.dom.resolutionRadios.forEach(radio => {
      radio.addEventListener('change', () => this.changeResolution(radio.value));
    });
    
    this.dom.random.addEventListener('click', () => this.getNextMeme());
    
    this.dom.download.addEventListener('click', () => this.downloadMeme());
  }
  
  changeResolution(resolution, updateRadio = false) {
    this.dom.meme.classList.remove('is-standard', 'is-hd', 'is-4k');
    this.dom.meme.classList.add(`is-${resolution}`);

    if (resolution === 'standard') {
      this.resolution = '';
    } else {
      this.resolution = resolution;
    }
    
    if (updateRadio) {
      console.log(resolution)
      document.querySelector(`input[value="${resolution}"]`).checked = true;
    } else {
      this.updateURL();
    }
  }
  
  getNextMeme() {
    this.index += 1;

    if (this.index > this.memesArr.length - 1) {
      this.index = 0;
      this.shuffleMemes();
    }

    this.obj = this.memesArr[this.index];
    
    this.updateMeme(this.memesArr[this.index]);
  }

  updateURL() {
    let url = '';
    let title = 'Winnie le caca';

    if (this.obj.slug) {
      url = `https://winnie.smnarnold.com/${this.obj.slug}`;
    }

    if(this.resolution) {
      url += `/${this.resolution}`;
    }

    if (this.obj.no1.text) {
      title += ` - ${this.obj.no1.text}`;
    }

    window.history.replaceState({}, title, url);
  }
  
  updateMeme(obj) {
    if (obj.no1.text) {
      this.dom.text1.innerText = obj.no1.text;
      this.dom.text1.style.backgroundImage = 'none';
    } else if (obj.no1.img) {
      this.dom.text1.innerText = '';
      this.dom.text1.style.backgroundImage = obj.no1.img;
    }
    
    if (obj.no2.text) {
      this.dom.text2.innerText = obj.no2.text;
      this.dom.text2.style.backgroundImage = 'none';
    } else if (obj.no2.img) {
      this.dom.text2.innerText = '';
      this.dom.text2.style.backgroundImage = `url(${obj.no2.img})`;
    }
    
    if (obj.source) {
      this.dom.source.display = 'block';
      this.dom.url.innerText = obj.source;
      this.dom.url.href = obj.source;
    } else {
      this.dom.source.display = 'none';
    }

    this.updateURL(obj);
  }
  
  downloadMeme() {
    html2canvas(this.dom.meme).then(canvas => {
      const image = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");
      
      this.dom.hrefDownload.href = image;
      this.dom.hrefDownload.download = `winnie-${this.obj.slug}.png`;
      this.dom.hrefDownload.click();
    });
  }
}

const winnie = new Winnie();