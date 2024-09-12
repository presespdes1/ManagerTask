import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import { Transition } from "@headlessui/react";
import ItemList from "@/Components/ItemList";
import List from "@/Components/List";
import { useState } from "react";

export default function Projects({ auth, projects, tasks, project_selected }) {
    const [projectSelected, setProjectSelected] = useState(project_selected);
       
    const listProjects = projects ? (
        projects.map((project) => (
            <ItemList key={project.id} className="item-list__project">
                <Link
                    href={route("project.tasks", [project.id])}
                    className="item-link"                    
                >
                    {`${project.name} ${project.archived ? "(Archivado)" : ""}`}
                </Link>
                <div className="item-list__buttons">
                    <Link
                        preserveState
                        href={route("projects.delete", [project.id])}
                        method="delete"
                        as="button"
                        className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    >
                        Eliminar
                    </Link>
                    <Link
                        preserveState
                        as="button"
                        href={route("project.update.form", [project.id])}
                        className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    >
                        Actualizar
                    </Link>
                </div>
            </ItemList>
        ))
    ) : (
        <ItemList
            className="item-list__project"
            value="No tienes proyectos creados"
        ></ItemList>
    );

    //Tareas
    const listTasks = tasks ? (
        tasks.map((task) => {
            return (
                task.project_id == projectSelected.id && (
                    <ItemList key={task.id} className="item-list__project">
                        <Link
                            href={route("task.show", [task.id])}
                            className="item-link"
                        >
                            {task.name}
                        </Link>
                        {
                            projectSelected.archived === 0 && 
                            (
                                <div className="item-list__buttons">                            
                        
                            <Link
                                preserveState
                                href={route("task.delete", [task.id])}
                                method="delete"
                                as="button"
                                className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            >
                                Eliminar
                            </Link>
                            <Link
                                preserveState
                                as="button"
                                href={route("task.update.form", [task.id])}
                                className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            >
                                Actualizar
                            </Link>
                            
                        </div>
                            )
                        }
                        
                    </ItemList>
                )
            );
        })
    ) : (
        <ItemList
            className="item-list__project"
            value="No hay tareas en el proyecto"
        ></ItemList>
    );

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Mis Proyectos
                </h2>
            }
        >
            <Head title="Dashboard" />
            <section className="container">
                <div className="sub-container">
                    <Link
                        href={route("project.create.form")}
                        preserveState
                        className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    >
                        Nuevo Proyecto
                    </Link>
                    <List
                        className="project-container"
                        children={listProjects}
                    />
                </div>
                <div className="sub-container">
                    {(projectSelected !== null && projectSelected.archived === 0) ? (
                        <Link
                            href={route("task.create.form", [projectSelected.id])}
                            preserveState
                            className="item-button px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        >
                            Nueva Tarea
                        </Link>
                    ) : (
                       <Link
                        preserveState 
                        className="item-button px-2 py-1 bg-gray-400 dark:bg-gray-100 border border-transparent rounded-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                       >Tareas de un proyecto archivado</Link>
                    )}
                    <List className="project-container" children={listTasks} />
                </div>
            </section>
        </AuthenticatedLayout>
    );
}
