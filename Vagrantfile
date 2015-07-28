VAGRANTFILE_API_VERSION = "2"

Vagrant.require_version ">= 1.7.4"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

    # Box configuration
    config.vm.box = "parallels/ubuntu-14.04"

    # VM configuration
    config.vm.provider "parallels" do |v|
        v.memory = 512
    end

    # Welcome message
    config.vm.post_up_message = "Development server is ready."

    # Port forwarding
    config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true

    # Synced folders
    config.vm.synced_folder ".", "/vagrant", :owner => 'root', :group => 'root', :mount_options => ["share"]

    # Provisioning script
    config.vm.provision "shell", path: "bootstrap.sh"

end