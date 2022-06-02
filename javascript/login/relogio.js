'use strict'

const getHoras = () => {
    const relogio = document.getElementsByClassName('relogio')[0]
    const data = new Date()
    const horas = data.getHours()
    const minutos = data.getMinutes()
    const segundos = data.getSeconds()
    const hora = horas < 10 ? `0${horas}` : horas
    const minuto = minutos < 10 ? `0${minutos}` : minutos
    const segundo = segundos < 10 ? `0${segundos}` : segundos
    relogio.innerHTML = `${hora}:${minuto}:${segundo}`
  }
  
  setInterval(() => {
    getHoras()
  }, 1000)