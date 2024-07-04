import React, { useEffect, useState } from 'react';

import {
    Button, Modal, ModalHeader, ModalBody, 
    ModalFooter, Form, FormGroup, Label, Input 
} from 'reactstrap';

import axios from 'axios';


const CitasModal = ( {isOpen, toggleModal, onCitaInsert, isEditar, citaEditar}) => {
    const [ fecha, setFecha] = useState('');
    const [ hospital, setHospital] = useState('');
    const [ idMedico, setIdMedico] = useState('');
    const [ idServicio, setIdServicio] = useState('');
    const [ idCliente, setIdCliente] = useState('');
    const [ estado, setEstado] = useState('');
    const [ idCita, setIdCita] = useState('');




    useEffect ( ()=>{

        if(citaEditar){
            setFecha(citaEditar.Fecha);
            setHospital(citaEditar.Hospital);
            setIdMedico(citaEditar.IdMedico);
            setIdServicio(citaEditar.idServicio);
            setIdCliente(citaEditar.IdCliente);
            setEstado(citaEditar.Estado);
            setIdCita(citaEditar.IdCita);
        }else{
            setFecha('');
            setHospital('');
            setIdMedico('');
            setIdServicio('');
            setIdCliente('');
            setEstado('');
            setIdCita('');
        }


    }, [citaEditar]);


    const cleanData = () =>{
        setFecha('');
        setHospital('');
        setIdMedico('');
        setIdServicio('');
        setIdCliente('');
        setEstado('');
        setIdCita('');
    }


    const handleSubmit = async () => {

        if(isEditar){
            try {
                const response = await axios.put('https://paginas-web-cr.com/ucr/multimedios0224/TeamLCHJ/apiProyecto/Cita/', 
                    {
                        idCita,
                        fecha,
                        hospital,
                        idMedico,
                        idServicio,
                        idCliente,
                        estado
                    }
                );
                console.log('Respuesta', response.data);
                onCitaInsert();
                cleanData();
                toggleModal();
            } catch (error) {
                console.error('Error en el API', error);
            }
        }
        else{
            try {
                const response = await axios.post('https://paginas-web-cr.com/ucr/multimedios0224/TeamLCHJ/apiProyecto/Cita/', 
                    {
                        fecha,
                        hospital,
                        idMedico,
                        idServicio,
                        idCliente,
                        estado
                    }
                );
                console.log('Respuesta', response.data);
                onCitaInsert();
                cleanData();
                toggleModal();
            } catch (error) {
                console.error('Error en el API', error);
            }
        }
    }


    return ( 

        <Modal isOpen={isOpen} toggle={toggleModal} >
        <ModalHeader toogle={toggleModal} > 
            {
                isEditar ? 'Editar Cita' : 'Insertar ' 
            }            
             </ModalHeader>
        <ModalBody>
            <Label>Fecha</Label>
            <Input type="text" id="Fecha" value={fecha} onChange={(e)=> setFecha(e.target.value)}></Input>
            <Label>Hospital</Label>
            <Input type="text" id="Hospital" value={hospital} onChange={(e)=> setHospital(e.target.value)}></Input>
            <Label>IdMedico</Label>
            <Input type="text" id="IdMedico" value={idMedico} onChange={(e)=> setIdMedico(e.target.value)}></Input>
            <Label>IdServicio</Label>
            <Input type="text" id="IdServicio" value={idServicio} onChange={(e)=> setIdServicio(e.target.value)}></Input>
            <Label>IdCliente</Label>
            <Input type="text" id="IdCliente" value={idCliente} onChange={(e)=> setIdCliente(e.target.value)}></Input>
            <Label>Estado</Label>
            <Input type="text" id="Estado" value={estado} onChange={(e)=> setEstado(e.target.value)}></Input>                                                                                                                                                                       
        </ModalBody>
        <ModalFooter>
        <Button color='success' onClick={handleSubmit}>
            Guardar
        </Button>
        <Button color='danger' onClick={toggleModal}>
            Cerrar
        </Button>


        </ModalFooter>
    </Modal>
        


     );
}

export default CitasModal;