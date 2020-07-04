var token = 'gLUHmvSZmlYT_8haRYuY'
var rand = Math.floor(Math.random() * 2390) + 1
var quote
var chracter_id
var name


function makeRequest(type) {
    return new Promise(resolve => {
        var request = new XMLHttpRequest()
        request.open("GET", `https://the-one-api.herokuapp.com/v1/${type}`, true)
        request.setRequestHeader('Authorization', 'Bearer ' + token)
        request.onload = function () {
            resolve(JSON.parse(request.response))
        }
        request.onerror = function () {
            console.log('fehler')
        }
        request.send()
    })

}

makeRequest('quote').then(response => {
    console.log(response)
    chracter_id = manDOM(response)
    makeRequest(`character/${chracter_id}`).then(response => {
        getCharacterName(response)
    })


})


function manDOM(response) {

    if (response.docs[rand].dialog.length > 15) {
        rand = Math.floor(Math.random() * 2390) + 1
        quote = response.docs[rand].dialog

    }

    if (!quote){
        quote = 'A API Request is never late, nor is he early, he arrives precisely when he means to.'
        chracter_id = 'Gandalf the Gray...the White...the API Request'

    }
    document.getElementById('quote').innerText = quote
    return response.docs[rand].character
}


function getCharacterName(response) {
    console.log(response.name)
    name = response.name
    if (!chracter_id) chracter_id = 'Gandalf the Gray...the White...the API Request'
    document.getElementById('author').innerText = name


}



