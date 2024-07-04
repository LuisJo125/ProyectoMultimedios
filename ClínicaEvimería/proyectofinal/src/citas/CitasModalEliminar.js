import React, { useEffect, useState } from 'react';

import {
    Button, Modal, ModalHeader, ModalBody, 
    ModalFooter, Form, FormGroup, Label, Input 
} from 'reactstrap';

import axios from 'axios';


const CitasModalEliminar = ( {isOpen, toggleModalEliminar, onCitaEliminar, citaEliminar}) => {
    const [ idCita, setIdCita] = useState("");


    useEffect ( ()=>{

        if(citaEliminar){
            setIdCita(citaEliminar.IdCita);
        }else{
            setIdCita('');
        }


    }, [citaEliminar]);


    const cleanData = () =>{
        setIdCita('');
    }


    const handleSubmit = async () => {   

        try {
            console.log(idCita);
            const response = await axios.delete('https://paginas-web-cr.com/ucr/multimedios0224/TeamLCHJ/apiProyecto/Cita/', 
                {
                    data: { idCita }
                }
            );
          
            console.log('Respuesta', response.data);
            onCitaEliminar();
            cleanData();
            toggleModalEliminar();
        } catch (error) {
            console.error('Error en el API', error);
        }
    }


    return ( 

        <Modal isOpen={isOpen} toggle={toggleModalEliminar} >
        <ModalHeader toogle={toggleModalEliminar} > 
            {
                'Eliminar cita' 
            }            
             </ModalHeader>
        <ModalBody>
            <Label>¿Desea eliminar la cita número <span id="idCita" value={idCita} onChange={(e)=> setIdCita(e.target.value)}>?</span></Label>
            <Input type="text" id="idCita" value={idCita} onChange={(e)=> setIdCita(e.target.value)} readOnly></Input>

            
        </ModalBody>
        <ModalFooter>
        <Button color='danger' onClick={handleSubmit}>
            Confirmar
        </Button>
        <Button color='secondary' onClick={toggleModalEliminar}>
            Cerrar
        </Button>


        </ModalFooter>
    </Modal>
        


     );
}

export default CitasModalEliminar;