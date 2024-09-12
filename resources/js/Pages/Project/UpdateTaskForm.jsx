import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, Link } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import Select from "@/Components/Select";

export default function UpdateTaskForm(
    { 
        className = "", 
        stateCases, 
        priorityCases,
        task 
}) 
{
    const { data, setData, put, processing, errors, reset } = useForm({
        name: task.name,
        state: task.state,
        priority: task.priority,       
        id: task.id
    });   
    
    const stateOptions = stateCases.map((s) => 
        (
            <option key={s['value']} value={s['value']}>{s['name']}</option>
        ));
    const priorityOptions = priorityCases.map((s) => 
        (
            <option key={s['value']} value={s['value']}>{s['name']}</option>
        ));

    const submit = (e) => {
        e.preventDefault();

        put(route("task.update"), {
            onFinish: () => reset("name"),
        });
    };
    return (
        <div className={`form-container` + className}>
            <h2 className="form__title">Crea tu Tarea</h2>

            <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="name" value="Nombre" />

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="state" value="Estado" />

                    <Select
                        id="state"
                        name="state"                        
                        value={data.state}
                        className="mt-1 block w-full"                       
                        isFocused={true}
                        onChange={(e) => setData("state", e.target.value)}
                    > {stateOptions}
                    </Select>
                    
                </div>
                <div>
                    <InputLabel htmlFor="priority" value="Prioridad" />

                    <Select
                        id="priority"
                        name="priority"                        
                        value={data.priority}
                        className="mt-1 block w-full"                       
                        isFocused={true}
                        onChange={(e) => setData("priority", e.target.value)}
                    > {priorityOptions}
                    </Select>
                    
                </div>
                <div className="flex form__buttons mt-4">
                    <PrimaryButton className="ms-4" disabled={processing}>
                        Actualizar
                    </PrimaryButton>
                    <Link
                        href={route("projects")}
                        className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    );
}
