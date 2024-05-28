import {url} from "./configuration";


export const register = async (body) => {
    const response = await fetch(`${url}/register`, {
        method: 'POST',
        headers:{
            Accept: "application/json",
            "Content-Type": 'application/json'
        },
        body: JSON.stringify(body)
    })  

    return await response.json()
}

export const checkToken = async (body) => {
    const response = await fetch(`${url}/register`, {
        method: 'GET',
        headers:{
            Accept: "application/json",
            "Content-Type": 'application/json',
            Authorization: `Bearer ${token}`
        },
        body: JSON.stringify(body)
    })  

    return await response.json()
}