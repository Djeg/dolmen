<?php

namespace Dolmen\Command\Launcher;

/**
 * A simple list of all the Launcher events.
 *
 * @author David Jegat <david.jegat@gmail.com>
 */
final class LauncherEvents
{
    const PRE_EXECUTE     = 'dolmen.launcher.pre_execute';

    const VALIDATE_INPUT  = 'dolmen.launcher.validate_input';

    const VALIDATE_OUTPUT = 'dolmen.launcher.validate_output';

    const POST_EXECUTE    = 'dolmen.launcher.post_execute';
}
