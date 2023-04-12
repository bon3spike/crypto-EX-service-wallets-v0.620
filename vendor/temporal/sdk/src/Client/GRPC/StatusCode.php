<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/spiral/php-grpc/blob/master/src/StatusCode.php
 */

declare(strict_types=1);

namespace Temporal\Client\GRPC;

/**
 * GRPC specific status codes. Sources from Go/GRPC implementation.
 */
final class StatusCode
{
    // OK is returned on success.
    public const OK = 0;

    // Canceled indicates the operation was canceled (typically by the caller).
    public const CANCELLED = 1;

    // Unknown error. An example of where this error may be returned is
    // if a Status value received from another address space belongs to
    // an error-space that is not known in this address space. Also
    // errors raised by APIs that do not return enough error information
    // may be converted to this error.
    public const UNKNOWN = 2;

    // InvalidArgument indicates client specified an invalid argument.
    // Note that this differs from FailedPrecondition. It indicates arguments
    // that are problematic regardless of the state of the system
    // (e.g., a malformed file name).
    public const INVALID_ARGUMENT = 3;

    // DeadlineExceeded means operation expired before completion.
    // For operations that change the state of the system, this error may be
    // returned even if the operation has completed successfully. For
    // example, a successful response from a server could have been delayed
    // long enough for the deadline to expire.
    public const DEADLINE_EXCEEDED = 4;

    // NotFound means some requested entity (e.g., file or directory) was
    // not found.
    public const NOT_FOUND = 5;

    // AlreadyExists means an attempt to create an entity failed because one
    // already exists.
    public const ALREADY_EXISTS = 6;

    // PermissionDenied indicates the caller does not have permission to
    // execute the specified operation. It must not be used for rejections
    // caused by exhausting some resource (use ResourceExhausted
    // instead for those errors). It must not be
    // used if the caller cannot be identified (use Unauthenticated
    // instead for those errors).
    public const PERMISSION_DENIED = 7;

    // ResourceExhausted indicates some resource has been exhausted, perhaps
    // a per-user quota, or perhaps the entire file system is out of space.
    public const RESOURCE_EXHAUSTED = 8;

    // FailedPrecondition indicates operation was rejected because the
    // system is not in a state required for the operation's execution.
    // For example, directory to be deleted may be non-empty, an rmdir
    // operation is applied to a non-directory, etc.
    //
    // A litmus test that may help a service implementor in deciding
    // between FailedPrecondition, Aborted, and Unavailable:
    //  (a) Use Unavailable if the client can retry just the failing call.
    //  (b) Use Aborted if the client should retry at a higher-level
    //      (e.g., restarting a read-modify-write sequence).
    //  (c) Use FailedPrecondition if the client should not retry until
    //      the system state has been explicitly fixed. E.g., if an "rmdir"
    //      fails because the directory is non-empty, FailedPrecondition
    //      should be returned since the client should not retry unless
    //      they have first fixed up the directory by deleting files from it.
    //  (d) Use FailedPrecondition if the client performs conditional
    //      REST Get/Update/Delete on a resource and the resource on the
    //      server does not match the condition. E.g., conflicting
    //      read-modify-write on the same resource.
    public const FAILED_PRECONDITION = 9;

    // Aborted indicates the operation was aborted, typically due to a
    // concurrency issue like sequencer check failures, transaction aborts,
    // etc.
    //
    // See litmus test above for deciding between FailedPrecondition,
    // Aborted, and Unavailable.
    public const ABORTED = 10;

    // OutOfRange means operation was attempted past the valid range.
    // E.g., seeking or reading past end of file.
    //
    // Unlike InvalidArgument, this error indicates a problem that may
    // be fixed if the system state changes. For example, a 32-bit file
    // system will generate InvalidArgument if asked to read at an
    // offset that is not in the range [0,2^32-1], but it will generate
    // OutOfRange if asked to read from an offset past the current
    // file size.
    //
    // There is a fair bit of overlap between FailedPrecondition and
    // OutOfRange. We recommend using OutOfRange (the more specific
    // error) when it applies so that callers who are iterating through
    // a space can easily look for an OutOfRange error to detect when
    // they are done.
    public const OUT_OF_RANGE = 11;

    // Unimplemented indicates operation is not implemented or not
    // supported/enabled in this service.
    public const UNIMPLEMENTED = 12;

    // Internal errors. Means some invariants expected by underlying
    // system has been broken. If you see one of these errors,
    // something is very broken.
    public const INTERNAL = 13;

    // Unavailable indicates the service is currently unavailable.
    // This is a most likely a transient condition and may be corrected
    // by retrying with a backoff.
    //
    // See litmus test above for deciding between FailedPrecondition,
    // Aborted, and Unavailable.
    public const UNAVAILABLE = 14;

    // DataLoss indicates unrecoverable data loss or corruption.
    public const DATA_LOSS = 15;

    // Unauthenticated indicates the request does not have valid
    // authentication credentials for the operation.
    public const UNAUTHENTICATED = 16;
}
