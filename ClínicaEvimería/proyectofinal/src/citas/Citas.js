import React, { useEffect, useState } from 'react';
import {
    Button, Modal, ModalHeader, ModalBody, ModalFooter, Form, FormGroup, Label, Input
} from 'reactstrap';

import CitasModal from './CitasModal';
import CitasModalEliminar from './CitasModalEliminar';

const CitasList = () => {
    //declaración de variables y arreglos
    const [citas, setCitas] = useState([]);
    const [modalOpen, setModalOpen] = useState(false); //se inicia el modal pero en apagado
    const [modalEliminarOpen, setModalEliminarOpen] = useState(false);
    const [citaEditar, setCitaEditar] = useState(null);
    const [citaEliminar, setCitaEliminar] = useState(null);
    const [isEditar, setIsEditar] = useState(false);

    //Ejecutar funciones, renderizar la pantalla o ejecuta scripts
    useEffect(() => {
        fetchCitas();
    }, []);

    //declarar funciones
    const fetchCitas = () => {
        fetch('https://paginas-web-cr.com/ucr/multimedios0224/TeamLCHJ/apiProyecto/Cita/')
            .then(repuesta => repuesta.json())
            .then((datosrepuestas) => {
                console.log(datosrepuestas);
                setCitas(datosrepuestas);
            })
            .catch(
                error => {
                    console.error("Error al cargar:", error);
                }
            )
    }

    const toggleEditModal = (cita) => {
        setCitaEditar(cita);

        if (cita) {
            setIsEditar(true);
        } else {
            setIsEditar(false);
        }

        setModalOpen(true);
    };

    const toggleDeleteModal = (cita) => {
        setCitaEliminar(cita);
        console.log("modal eliminar");
        setModalEliminarOpen(true);
    }

    const guardar = async () => {
        //similar al fetch
    }

    const toggleModal = () => {
        setModalOpen(!modalOpen);
    }

    const toggleModalEliminar = () => {
        setModalEliminarOpen(!modalEliminarOpen);
    }

    return (
        <div className='container'>
            <br></br><br></br><br></br>
            <Button color='primary' onClick={() => toggleEditModal(false)}>
                Agregar
            </Button>

            <table className="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">IdCita</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hospital</th>
                        <th scope="col">IdMedico</th>
                        <th scope="col">IdServicio</th>
                        <th scope="col">IdCliente</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="datos">
                    {
                        citas.map(citas => (
                            <tr key={citas.IdCita}>
                                <td>{citas.IdCita}</td>
                                <td>{citas.Fecha}</td>
                                <td>{citas.Hospital}</td>
                                <td>{citas.IdMedico}</td>
                                <td>{citas.IdServicio}</td>
                                <td>{citas.IdCliente}</td>
                                <td>{citas.Estado}</td>
                                <td>
                                    <Button color='primary' onClick={() => toggleEditModal(citas)}>Editar</Button>
                                    <Button color='primary' onClick={() => toggleDeleteModal(citas)}>Eliminar</Button>
                                </td>
                            </tr>
                        ))
                    }
                </tbody>
            </table>

            {/* <Modal isOpen={modalOpen}>
                <ModalHeader>Modal Curso</ModalHeader>
                <ModalBody>
                    <Label>Nombre</Label>
                    <Input type='text' id='nombre' value={cursoEditar?.nombre || ''}></Input>
                    <Label>Descripcion</Label>
                    <Input type='text' id='descripcion' value={cursoEditar?.descripcion || ''}></Input>
                    <Label>Tiempo</Label>
                    <Input type='text' id='tiempo' value={cursoEditar?.tiempo || ''}></Input>
                    <Label>Usuario</Label>
                    <Input type='text' id='usuario' value={cursoEditar?.usuario || ''}></Input>
                </ModalBody>
                <ModalFooter>
                    <Button color='success' onClick={guardar}>
                        Guardar
                    </Button>
                    <Button color='danger' onClick={() => toggleEditModal(false)}>
                        Cerrar
                    </Button>
                </ModalFooter>
            </Modal> */}

            <CitasModal
                isOpen={modalOpen}
                toggleModal={toggleModal}
                onCitaInsert={fetchCitas}
                isEditar={isEditar}
                citaEditar={citaEditar}
            >
            </CitasModal>

            <CitasModalEliminar
                isOpen={modalEliminarOpen}
                toggleModalEliminar={toggleModalEliminar}
                onCitaEliminar={fetchCitas}
                citaEliminar={citaEliminar}
            >
            </CitasModalEliminar>
        </div>
    );
}

export default CitasList;