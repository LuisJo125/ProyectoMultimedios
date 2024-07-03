import React from 'react';

class menu extends React.Component {
    render() { 

        const {activeComponent, setActiveComponent} = this.props;

        const itemLink = (ventana) => {
            setActiveComponent(ventana);

            if(activeComponent = 'citas'){
                
            }
        }

        return ( 
            <div className="container">
                <nav className="navbar navbar-light bg-light fixed-top navbar-expand-lg">
                    <div className="container-fluid">
                        <ul className="navbar-nav">
                            <li className="nav-item">
                                <button className="nav-link btn btn-link" onClick={() => itemLink('principal')}> {/*Poner que este item mande a la vista principal*/}
                                    Evimería
                                </button>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link btn btn-link" onClick={() => setActiveComponent('citas')}>
                                    Citas
                                </button>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link btn btn-link" onClick={() => setActiveComponent('clientes')}>
                                    Clientes
                                </button>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link btn btn-link" onClick={() => setActiveComponent('empleados')}>
                                    Empleados
                                </button>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link btn btn-link" onClick={() => setActiveComponent('servicios')}>
                                    Servicios
                                </button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        );
    }
}
 
export default menu;